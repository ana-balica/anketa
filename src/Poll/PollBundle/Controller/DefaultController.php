<?php

namespace Poll\PollBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

    public function createpollAction()
    {
        return $this->render('PollPollBundle:Poll:create_poll.html.twig');
    }
}
