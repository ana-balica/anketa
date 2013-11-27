<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\PollImpl;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Respondent;
use Poll\PollBundle\Exception\AnswerDoesNotExistException;
use Symfony\Component\Config\Definition\Exception\Exception;

class LocalAnswerService implements AnswerService {

	/** @var Poll $poll */
	protected $poll;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

    /**
     * LocalAnswerService constructor
     */
    public function __construct(Poll $poll, LocalObjectFactory $objectFactory) {
        $this->poll = $poll;
        $this->objectFactory = $objectFactory;
    }

    /**
	 * Get the poll object
	 * @return Poll
	 */
	public function getPoll() {
        return $this->poll;
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
	 * Find the answer(s) according to its id
	 * @param number $id
     * @return Answer
	 * @throws \Poll\PollBundle\Exception\AnswerDoesNotExistException
	 */
	public function find($id) {
        try {
            $this->poll->getItem($id);
        } catch (Exception $e) {
            throw new AnswerDoesNotExistException("An answer by this id doesn't exist");
        }
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