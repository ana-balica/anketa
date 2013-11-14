<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\IdentifiedClass;

/**
 * Abstract implementation of Answer class
 *
 * @author AnaBalica
 */
abstract class AnswerImpl extends IdentifiedClass implements Answer {

	protected $respondent;
	protected $question;

	/**
	 * 
	 * @return Respondent
	 */
	public function getRespondent() {

	}

	/**
	 * 
	 * @param Respondent $respondent
	 */
	public function setRespondent(Respondent $respondent) {

	}

	/**
	 * 
	 * @return \Poll\PollBundle\Entity\Question
	 */
	public function getQuestion() {

	}

	/**
	 * 
	 * @param Question $question
	 * @return \Poll\PollBundle\Entity\Answer
	 * @throws \LogicException pokud trida/rozhrani, se kterou je odpoved kompatibilni, neexistuje
	 * @throws IncompatibleClassException otazka neni kompatibilni s touto odpovedi
	 */
	public function setQuestion(Question $question) {

	}
}