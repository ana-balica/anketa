<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Choice\ChoiceQuestion;
use Poll\PollBundle\Entity\Choice\Option;
use Poll\PollBundle\Entity\Choice\SharedOption;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;


class LocalQuestionService implements QuestionService {

	/** @var Poll $poll */
	protected $poll;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

    public function __construct(Poll $poll, LocalObjectFactory $objectFactory) {
        $this->poll = $poll;
        $this->objectFactory = $objectFactory;
    }

	/**
	 * 
	 * @return \Poll\PollBundle\Entity\Poll
	 */
	public function getPoll() {

	}
	
	/**
	 * 
	 * @param number $id
	 * @return \Poll\PollBundle\Entity\Question
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException
	 */
	public function find($id) {

	}
	
	/**
	 * 
	 * @param string $question text otazky
	 * @param number $type typ otazky - konstanta @see \Poll\PollBundle\Service\ObjectFactory
	 * @return \Poll\PollBundle\Entity\Question
	 */
	public function create($question, $type = ObjectFactory::TEXT_QUESTION) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException
	 */
	public function delete(Question $question) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException
	 */
	public function update(Question $question) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Choice\ChoiceQuestion $question otazka
	 * @param string $option text moznosti
	 * @param string $shared ma byt moznost sdilena mezi otazkami
	 * @param string $exclusive pokud ma byt sdilena, lze ji ve vsech otazkach vybrat vicekrat nebo jen jednou
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException pokud otazka neexistuje v ankete
	 */
	public function addOption(ChoiceQuestion $question, $option, $shared = false, $exclusive = false) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Choice\ChoiceQuestion $question otazka
	 * @param \Poll\PollBundle\Entity\Choice\SharedOption $option moznost
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException pokud otazka neexistuje v ankete
	 */
	public function addSharedOption(ChoiceQuestion $question, SharedOption $option) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Choice\ChoiceQuestion $question
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @throws FIXME pokud otazka neexistuje v ankete
	 * @throws FIXME pokud moznost v otazce neexistuje
	 */
	public function removeOption(ChoiceQuestion $question, Option $option) {
		
	}
}