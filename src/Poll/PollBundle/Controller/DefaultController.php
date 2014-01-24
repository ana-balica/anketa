<?php

namespace Poll\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Poll\PollBundle\Entity\PollImpl;
use Poll\PollBundle\Entity\QuestionImpl;
use Poll\PollBundle\Entity\Choice\OptionImpl;
use Poll\PollBundle\Form\NewPoll;
use Poll\PollBundle\Form\AddQuestion;
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

        $form = $this->createForm(new AddQuestion());

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

        $q = new PollQuery($em);
        $questions = $q->getQuestionsByPollId($poll_id);

        $form = $this->createFormBuilder();
        foreach ($questions as $question) {
            $type = $question->getQuestionType();
            if ($type == ObjectFactory::TEXT_QUESTION) {
                $form->add($question->getId(), 'textarea', array(
                    'label' => $question->getQuestion()));
            } else if ($type == ObjectFactory::SINGLE_CHOICE_QUESTION) {
                $expanded = True;
                $multiple = False;

            } else if ($type == ObjectFactory::MULTIPLE_CHOICE_QUESTION) {
                $expanded = True;
                $multiple = True;
            } else {
                throw new \Exception("Invalid question type");
            }
            if (in_array($type, array(ObjectFactory::SINGLE_CHOICE_QUESTION, ObjectFactory::MULTIPLE_CHOICE_QUESTION))) {
                $question_id = $question->getId();
                $options = $q->getOptionsArrayByQuestionId($question_id);
                $form_options = array();
                foreach ($options as $option) {
                    array_push($form_options, array($option['id'] => $option['option']));
                }
                $form->add($question->getId(), 'choice', array(
                    'choices' => $form_options,
                    'label' => $question->getQuestion(),
                    'expanded' => $expanded,
                    'multiple' => $multiple
                ));
            }
        }
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
}
