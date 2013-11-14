<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\AnswerImpl;

abstract class ChoiceAnswerImpl extends AnswerImpl implements ChoiceAnswer {

	/**
	 * @return Option|Options
	 */
	public function getAnswer() {
		
	}
}