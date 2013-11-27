<?php
namespace Poll\PollBundle\Entity\Text;

use Poll\PollBundle\Entity\QuestionImpl;
use Poll\PollBundle\Service\ObjectFactory;

/**
 * Implementace otazky s textovou odpovedi
 * @author kadleto2
 */
class TextQuestionImpl extends QuestionImpl implements TextQuestion {

    public function __construct() {
        parent::__construct();
        $this->type = ObjectFactory::TEXT_QUESTION;
    }
}