<?php
namespace Poll\PollBundle\Entity\Choice;

/**
 * Class SingleChoiceAnswerImpl
 * Represents an answer with a single choice
 * @package Poll\PollBundle\Entity\Choice
 */
class SingleChoiceAnswerImpl extends ChoiceAnswerImpl implements SingleChoiceAnswer {

	/**
	 * Set the answer
	 * @param Option $answer
	 * @return SingleChoiceAnswer
	 */
	public function setAnswer(Option $answer) {
		$this->answer = $answer;
        $this->answer->addAnswer($this);
		return $this;
	}
}