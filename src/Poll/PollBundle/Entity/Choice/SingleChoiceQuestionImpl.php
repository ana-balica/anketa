<?php
namespace Poll\PollBundle\Entity\Choice;

class SingleChoiceQuestionImpl extends ChoiceQuestionImpl implements SingleChoiceQuestion {

    public function __construct() {
        parent::__construct();
        $this->type = self::SINGLE_CHOICE_QUESTION;
    }
	
}