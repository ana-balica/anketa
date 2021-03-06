<?php

namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Service\ObjectFactory;


class MultipleChoiceQuestionImpl extends ChoiceQuestionImpl implements MultipleChoiceQuestion {

    public function __construct() {
        parent::__construct();
        $this->questionType = ObjectFactory::MULTIPLE_CHOICE_QUESTION;
    }

}