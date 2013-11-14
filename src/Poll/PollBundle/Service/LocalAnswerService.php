<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Respondent;

class LocalAnswerService implements AnswerService {

	/** @var Poll $poll */
	protected $poll;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

	/**
	 * 
	 * @return Poll
	 */
	public function getPoll() {

	}

	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @param \Poll\PollBundle\Entity\Respondent $respondent
	 * @return \Poll\PollBundle\Entity\Answer
	 */
	public function create(Question $question, Respondent $respondent) {

	}

	/**
	 * 
	 * @param number $id
	 * @throws \Poll\PollBundle\Exception\AnswerDoesNotExistException
	 */
	public function find($id) {

	}

	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Answer
	 * @param mixed - string | \Poll\PollBundle\Entity\Choice\Option
	 * @return \Poll\PollBundle\Entity\Answer
	 */
	public function setAnswer(Answer $answer, $value) {

	}
}