<?php
namespace Poll\PollBundle\Entity\Text;

use Poll\PollBundle\Entity\AnswerImpl;
use Poll\PollBundle\Entity\Question;

/**
 * Implementace textove odpovedi
 * @author kadleto2
 */
class TextAnswerImpl extends AnswerImpl implements TextAnswer {

	/**
	 * @return string
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 *
	 * @param string $answer
	 * @return TextAnswer
	 */
	public function setAnswer($answer) {
		$this->answer = $answer;
		return $this;
	}
}
