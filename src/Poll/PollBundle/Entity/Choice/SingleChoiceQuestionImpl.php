<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Service\ObjectFactory;

class SingleChoiceQuestionImpl extends ChoiceQuestionImpl implements SingleChoiceQuestion {

    public function __construct() {
        parent::__construct();
        $this->questionType = ObjectFactory::SINGLE_CHOICE_QUESTION;
    }
	
}