<?php
/**
 * Created by PhpStorm.
 * User: ana
 * Date: 1/21/14
 * Time: 12:42 PM
 */

namespace Poll\PollBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class AddQuestion extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('type', 'choice', array(
                'choices' => array('text' => 'Text question',
                                    'single' => 'Single choice question',
                                    'multiple' => 'Multiple choice question')))
            ->add('question_text', 'text')
            ->add('options', 'textarea', array('required' => False))
            ->add('addquestion', 'submit', array('label' => 'Add more questions'))
            ->add('done', 'submit', array('label' => 'Done'));
    }

    public function getName() {
        return 'addquestion';
    }
} 