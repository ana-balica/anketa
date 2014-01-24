<?php

namespace Poll\PollBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class NewQuestion extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('type', 'choice', array(
                'choices' => array('1' => 'Text question',
                                    '2' => 'Single choice question',
                                    '3' => 'Multiple choice question')))
            ->add('question_text', 'text')
            ->add('options', 'textarea', array('required' => False))
            ->add('addquestion', 'submit', array('label' => 'Add more questions'))
            ->add('done', 'submit', array('label' => 'Done'));
    }

    public function getName() {
        return 'addquestion';
    }
} 