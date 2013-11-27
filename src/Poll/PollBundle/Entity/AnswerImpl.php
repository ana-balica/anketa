<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Exception\IncompatibleClassException;

/**
 * Abstract implementation of Answer class
 *
 * @author AnaBalica
 */
abstract class AnswerImpl extends IdentifiedClass implements Answer {

    /** @var Respondent */
	protected $respondent;

    /** @var Question */
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
	 * Set the question
	 * @param Question $question
	 * @return \Poll\PollBundle\Entity\Answer
	 * @throws \LogicException pokud trida/rozhrani, se kterou je odpoved kompatibilni, neexistuje
	 * @throws IncompatibleClassException otazka neni kompatibilni s touto odpovedi
	 */
	public function setQuestion(Question $question) {
        if ($question instanceof \Question)
            throw new \LogicException("The question param should implement Question interface");

        $implemented_interfaces = class_implements(get_class($question));
        if (!in_array($this::COMPATIBLE_QUESTION, $implemented_interfaces))
            throw new IncompatibleClassException("The answer and the question are not compatible");
        $this->question = $question;
        $this->question->addAnswer($this);
		return $this;
	}
}