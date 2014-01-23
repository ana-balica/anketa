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

//    public function pollAction()
//    {
////        $polls = array();
////        $poll1 = array(
////            "id" => 1234,
////            "title" => "Cats vs Dogs",
////            "questions" => array(
////
////            ),
////        );
//        return $this->render('PollPollBundle:Poll:view_poll.html.twig', array('name' => "smth"));
//    }

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

    public function showpollAction(Request $request, $poll_id) {
        return $this->render('PollPollBundle:Default:index.html.twig');
    }
}
