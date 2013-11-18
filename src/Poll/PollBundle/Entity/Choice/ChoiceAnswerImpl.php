<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\AnswerImpl;

/**
 * Abstract class for general purpose ChoiceAnswer classes
 * @author AnaBalica
 */
abstract class ChoiceAnswerImpl extends AnswerImpl implements ChoiceAnswer {

	/** @var Option */
	protected $answer;
	
	/**
	 * Get the answer
	 * @return Option|Options
	 */
	public function getAnswer() {
		return $this->answer;
	}
}