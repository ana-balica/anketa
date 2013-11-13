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
	 * @param string $anwser
	 * @return TextAnswer
	 */
	public function setAnswer($anwser) {
		$this->answer = $anwser;
		return $this;
	}
}
