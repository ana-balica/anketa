<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Exception\InvalidOptionException;

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
     * @throws InvalidOptionException
	 */
	public function setAnswer(Option $answer) {
        if ($this->getQuestion()->hasOption($answer)) {
		    $this->answer = $answer;
            $this->answer->addAnswer($this);
        }
        else
            throw new InvalidOptionException("The following answer is not a valid option.");
		return $this;
	}
}