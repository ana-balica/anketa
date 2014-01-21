<?php

namespace Poll\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Poll\PollBundle\Form\NewPoll;
use Poll\PollBundle\Form\AddQuestion;

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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createpollAction(Request $request)
    {
        // create here the poll entity, will map everything to it
        $form = $this->createForm(new NewPoll());

        $form->handleRequest($request);
        if ($form->isValid()) {
            $id = 1;
            $title = "Some dummy title";
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
//        \Doctrine\Common\Util\Debug::dump($poll_id);
//        Extract the title of the poll
        $title = "Some dummy title";
        $form = $this->createForm(new AddQuestion());

        $form->handleRequest($request);
        if ($form->isValid()) {
            $next_action = $form->get('done')->isClicked() ? 'poll_show' : 'poll_add_question';
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
