<?php

namespace Poll\PollBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class EditQuestion extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('type', 'choice', array(
                'choices' => array('1' => 'Text question',
                                    '2' => 'Single choice question',
                                    '3' => 'Multiple choice question')))
            ->add('question', 'text')
            ->add('options', 'textarea', array('required' => False))
            ->add('done', 'submit', array('label' => 'Save'));
    }

    public function getName() {
        return 'editquestion';
    }
} 