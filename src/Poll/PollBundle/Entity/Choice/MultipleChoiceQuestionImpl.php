<?php

namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\Answer;

class MultipleChoiceQuestionImpl extends ChoiceQuestionImpl implements MultipleChoiceQuestion {

    public function __construct() {
        parent::__construct();
        $this->type = self::MULTIPLE_CHOICE_QUESTION;;
    }

}