<?php

namespace Poll\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Poll\PollBundle\Form\NewPoll;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PollPollBundle:Default:index.html.twig');
    }

    public function pollAction()
    {
//        $polls = array();
//        $poll1 = array(
//            "id" => 1234,
//            "title" => "Cats vs Dogs",
//            "questions" => array(
//
//            ),
//        );
        return $this->render('PollPollBundle:Poll:view_poll.html.twig', array('name' => "smth"));
    }

    /**
     * Create a poll by providing it's title and short description
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


    public function showpollAction(Request $request, $poll_id) {
        return $this->render('PollPollBundle:Default:index.html.twig');
    }
}
