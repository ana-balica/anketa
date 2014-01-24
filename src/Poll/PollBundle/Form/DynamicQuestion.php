<?php

namespace Poll\PollBundle\Form;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Entity\QuestionImpl;
use Poll\PollBundle\Query\PollQuery;


class DynamicQuestion {

    /**
     * @var Form
     */
    protected $form;

    /**
     * @var object The instance of the given service
     */
    protected $em;

    public function __construct($form, $em) {
        $this->form = $form;
        $this->em = $em;
    }

    public function buildQuestion(QuestionImpl $question) {
        $type = $question->getQuestionType();

        if ($type == ObjectFactory::TEXT_QUESTION) {
            $this->form->add($question->getId(), 'textarea', array(
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
            $q = new PollQuery($this->em);
            $options = $q->getOptionsArrayByQuestionId($question_id);
            $form_options = array();
            foreach ($options as $option) {
                array_push($form_options, array($option['id'] => $option['option']));
            }
            $this->form->add($question->getId(), 'choice', array(
                'choices' => $form_options,
                'label' => $question->getQuestion(),
                'expanded' => $expanded,
                'multiple' => $multiple
            ));
        }

        return $this->form;
    }
} 