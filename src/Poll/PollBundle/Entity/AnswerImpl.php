<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Exception;

/**
 * Abstract implementation of Answer class
 *
 * @author AnaBalica
 */
abstract class AnswerImpl extends IdentifiedClass implements Answer {

	protected $respondent;
	protected $question;

	/**
	 * Get the respondent of the answer
	 * @return Respondent
	 */
	public function getRespondent() {
		return $this->respondent;
	}

	/**
	 * Set the respondent of the answer
	 * @param Respondent $respondent
	 */
	public function setRespondent(Respondent $respondent) {
		$this->respondent = $respondent;
	}

	/**
	 * Get the initial question
	 * @return \Poll\PollBundle\Entity\Question
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * 
	 * @param Question $question
	 * @return \Poll\PollBundle\Entity\Answer
	 * @throws \LogicException pokud trida/rozhrani, se kterou je odpoved kompatibilni, neexistuje
	 * @throws IncompatibleClassException otazka neni kompatibilni s touto odpovedi
	 */
	public function setQuestion(Question $question) {
		// TODO: throw IncompatibleClassException 
		// what does mean for an answer and a question to be compatible?
		if ($question instanceof \Question)
			throw new \LogicException("The question param should implement Question interface");
		$this->question = $question;
		return $this;
	}
}