<?php

namespace Poll\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Poll\PollBundle\Entity\PollImpl;
use Poll\PollBundle\Entity\QuestionImpl;
use Poll\PollBundle\Entity\AnswerImpl;
use Poll\PollBundle\Entity\UniversalQuestion;
use Poll\PollBundle\Entity\Choice\OptionImpl;
use Poll\PollBundle\Form\NewPoll;
use Poll\PollBundle\Form\NewQuestion;
use Poll\PollBundle\Form\DynamicQuestion;
use Poll\PollBundle\Form\EditQuestion;
use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Query\PollQuery;


class DefaultController extends Controller
{
    /**
     * Homepage of the website
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('PollPollBundle:Default:index.html.twig');
    }

    /**
     * Display and submit a form with a poll by providing it's title and short description
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createpollAction(Request $request)
    {
        $poll = new PollImpl();
        $form = $this->createForm(new NewPoll(), $poll);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poll);
            $em->flush();
            $id = $poll->getId();
            return $this->redirect($this->generateUrl('poll_add_question', array("poll_id" => $id)));
        }
        return $this->render('PollPollBundle:Poll:create_poll.html.twig', array('form' => $form->createView()));
    }

    /**
     * Add a question of any of 3 types to the poll
     *
     * @param Request $request
     * @param $poll_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addquestionAction(Request $request, $poll_id)
    {
        $em = $this->getDoctrine()->getManager();
        $poll = $em->getRepository('PollPollBundle:PollImpl')->find($poll_id);
        $title = $poll->getTitle();

        $form = $this->createForm(new NewQuestion());

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getViewData();
            // create question entity and fill the data
            $question = new QuestionImpl();
            $question->setPollId($poll);
            $question->setQuestionType($data["type"]);
            $question->setQuestion($data["question_text"]);
            $em->persist($question);
            $em->flush();

            if (in_array($data["type"], array(
                    ObjectFactory::SINGLE_CHOICE_QUESTION,
                    ObjectFactory::MULTIPLE_CHOICE_QUESTION))) {
                $options = $data["options"];
                $options = preg_split('/\R/', $options);

                $question_entity = $em->getRepository('PollPollBundle:QuestionImpl')->find($question->getId());

                foreach ($options as $opt) {
                    // create option entity and fill the data
                    $option = new OptionImpl();
                    $option->setPoll($poll);
                    $option->setOption($opt);
                    $option->setQuestion($question_entity);
                    $em->persist($option);
                }
                $em->flush();
            }

            $next_action = $form->get('done')->isClicked() ? 'poll_show_one' : 'poll_add_question';
            return $this->redirect($this->generateUrl($next_action, array("poll_id" => $poll_id)));
        }
        return $this->render('PollPollBundle:Poll:add_question.html.twig', array(
            'form' => $form->createView(),
            'title' => $title));
    }

    /**
     * List all the polls by providing the titles and linking them to the full poll representations
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showpollsAction()
    {
        $polls = $this->getDoctrine()->getRepository('PollPollBundle:PollImpl')->findAll();
        return $this->render('PollPollBundle:Poll:show_polls.html.twig', array("polls" => array_reverse($polls)));
    }

    /**
     * Show poll and display its title, description, all questions with all available options
     *
     * @param Request $request
     * @param string $poll_id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function showpollAction(Request $request, $poll_id)
    {
        $em = $this->getDoctrine()->getManager();
        $poll = $em->getRepository('PollPollBundle:PollImpl')->find($poll_id);
        $title = $poll->getTitle();
        $description = $poll->getDescription();

        $questions = $em->getRepository('PollPollBundle:QuestionImpl')->findBy(array('poll_id' => $poll_id));

        $form = $this->createFormBuilder();
        $dq = new DynamicQuestion($form, $em);
        foreach ($questions as $question) {
            $form = $dq->buildQuestion($question);
        }
        $form->setAction($this->generateUrl('poll_add_answers', array('poll_id' => $poll_id)));
        $form->add('submit', 'submit', array(
            'label' => "Submit",
            'attr' => array(
                'class' => 'btn btn-primary')));

        $form = $form->getForm();
        return $this->render('PollPollBundle:Poll:show_poll.html.twig', array(
            'id' => $poll_id,
            'title' => $title,
            'description' => $description,
            'form' => $form->createView()));
    }

    /**
     * Delete a poll with all it's questions, answers and options
     *
     * @param string $poll_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletepollAction($poll_id) {
        $em = $this->getDoctrine()->getManager();
        $poll = $em->getRepository('PollPollBundle:PollImpl')->find($poll_id);
        $em->remove($poll);
        $em->flush();

        return $this->redirect($this->generateUrl('poll_show_all'));
    }

    /**
     * Edit a poll: edit the title and the description
     *
     * @param Request $request
     * @param string $poll_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editpollAction(Request $request, $poll_id) {
        $em = $this->getDoctrine()->getManager();
        $poll = $em->getRepository('PollPollBundle:PollImpl')->find($poll_id);

        $form = $this->createForm(new NewPoll(), $poll);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($poll);
            $em->flush();
            return $this->redirect($this->generateUrl('poll_show_one', array("poll_id" => $poll_id)));
        }
        return $this->render('PollPollBundle:Poll:edit_poll.html.twig', array('form' => $form->createView()));
    }

    /**
     * Delete a question
     *
     * @param string $question_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletequestionAction($question_id) {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('PollPollBundle:QuestionImpl')->find($question_id);
        $poll_id = $question->getPollId()->getId();
        $em->remove($question);
        $em->flush();

        return $this->redirect($this->generateUrl('poll_show_one', array("poll_id" => $poll_id)));
    }

    /**
     * Edit a question - can change type, text, options (if necessary)
     *
     * @param Request $request
     * @param string $question_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editquestionAction(Request $request, $question_id) {
        $em = $this->getDoctrine()->getManager();
        $question = $em->getRepository('PollPollBundle:QuestionImpl')->find($question_id);
        $options = $em->getRepository('PollPollBundle:Choice\OptionImpl')->findBy(array('question' => $question_id));

        $universal_question = new UniversalQuestion();
        $universal_question->populateQuestion($question);
        $universal_question->populateOptions($options);

        $form = $this->createForm(new EditQuestion(), $universal_question);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $question = $question->populateQuestion($universal_question);
            $em->persist($question);

            foreach ($options as $option) {
                $em->remove($option);
            }

            if (in_array($universal_question->getType(), array(
                    ObjectFactory::SINGLE_CHOICE_QUESTION,
                    ObjectFactory::MULTIPLE_CHOICE_QUESTION))) {
                $options = $universal_question->getOptions();
                $options = preg_split('/\R/', $options);
                $poll = $question->getPollId();

                foreach ($options as $opt) {
                    $option = new OptionImpl();
                    $option->setPoll($poll);
                    $option->setOption($opt);
                    $option->setQuestion($question);
                    $em->persist($option);
                }
            }

            $em->flush();
            return $this->redirect($this->generateUrl('poll_show_one', array("poll_id" => $question->getPollId()->getId())));
        }
        return $this->render('PollPollBundle:Poll:edit_question.html.twig', array('form' => $form->createView()));
    }

    /**
     * Add and save to db answers to a varying number of questions of a poll
     *
     * @param Request $request
     * @param string $poll_id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addanswersAction(Request $request, $poll_id) {
        $em = $this->getDoctrine()->getManager();
        $questions = $em->getRepository('PollPollBundle:QuestionImpl')->findBy(array('poll_id' => $poll_id));

        $form_data = $request->request->get('form');

        foreach($questions as $question) {
            $question_id = $question->getId();
            $question_type = $question->getQuestionType();
            $answer_text = $form_data[$question_id];
            if (in_array($question_type, array(
                    ObjectFactory::TEXT_QUESTION,
                    ObjectFactory::SINGLE_CHOICE_QUESTION))) {
                $answer = new AnswerImpl();
                $answer->setAnswerType($question->getQuestionType());
                $answer->setAnswerText($answer_text);
                $answer->setQuestionEntity($question);
                $answer->setPoll($question->getPollId());
                if ($question_type == ObjectFactory::SINGLE_CHOICE_QUESTION) {
                    $option = $em->getRepository('PollPollBundle:Choice\OptionImpl')->find($answer_text);
                    $answer->addOption($option);
                }
                $em->persist($answer);
            } else if ($question_type == ObjectFactory::MULTIPLE_CHOICE_QUESTION) {
                foreach($answer_text as $ans) {
                    $answer = new AnswerImpl();
                    $answer->setAnswerType($question->getQuestionType());
                    $answer->setAnswerText($ans);
                    $answer->setQuestionEntity($question);
                    $answer->setPoll($question->getPollId());
                    $option = $em->getRepository('PollPollBundle:Choice\OptionImpl')->find($ans);
                    $answer->addOption($option);
                    $em->persist($answer);
                }
            } else {
                throw new \Exception("Invalid question type.");
            }
        }

        $em->flush();
        return $this->redirect($this->generateUrl('poll_show_all'));
    }

    /**
     * Display results of a poll
     *
     * @param string $poll_id
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function resultsAction($poll_id) {
        $em = $this->getDoctrine()->getManager();
        $poll = $em->getRepository('PollPollBundle:PollImpl')->find($poll_id);
        $questions = $em->getRepository('PollPollBundle:QuestionImpl')->findBy(array('poll_id' => $poll_id));
        $results = array();

        foreach ($questions as $key=>$question) {
            $question_id = $question->getId();
            $question_type = $question->getQuestionType();
            $results[$key] = array("question" => $question->getQuestion());

            $answers = $em->getRepository('PollPollBundle:AnswerImpl')->findBy(array('question' => $question_id));
            $answer_texts = array();
            foreach ($answers as $answer) {
                $answer_texts[] = $answer->getAnswerText();
            }

            if ($question_type == ObjectFactory::TEXT_QUESTION) {
                $results[$key]["answers"] = $answer_texts;
            } else if (in_array($question_type, array(
                    ObjectFactory::SINGLE_CHOICE_QUESTION,
                    ObjectFactory::MULTIPLE_CHOICE_QUESTION))) {
                $options = $em->getRepository('PollPollBundle:Choice\OptionImpl')->findBy(array('question' => $question_id));
                $results[$key]['answers'] = array();
                foreach ($options as $option) {
                    $pq = new PollQuery($em);
                    $count = $pq->getAnswerCountryByOptionId($option);
                    $option_text = $option->getOption();
                    $results[$key]['answers'][] = $count . " - " . $option_text;
                }
            } else {
                throw new \Exception("Invalid question type");
            }
        }
        return $this->render('PollPollBundle:Poll:poll_results.html.twig', array('poll' => $poll, 'results' => $results));
    }
}
