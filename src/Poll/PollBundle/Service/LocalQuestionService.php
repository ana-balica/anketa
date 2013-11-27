<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Choice\ChoiceQuestion;
use Poll\PollBundle\Entity\Choice\Option;
use Poll\PollBundle\Entity\Choice\SharedOption;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Exception\QuestionDoesNotExistException;


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
	 * Get poll attribute
	 * @return \Poll\PollBundle\Entity\Poll
	 */
	public function getPoll() {
        return $this->poll;
	}
	
	/**
	 * Find the question according to its id
	 * @param number $id
	 * @return \Poll\PollBundle\Entity\Question
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException
	 */
	public function find($id) {
        try {
            return $this->poll->getItem($id);
        } catch (\Exception $e) {
            throw new QuestionDoesNotExistException("An question by this id doesn't exist");
        }
	}
	
	/**
	 * Create a new question with the given string
	 * @param string $question text otazky
	 * @param number $type typ otazky - konstanta @see \Poll\PollBundle\Service\ObjectFactory
	 * @return \Poll\PollBundle\Entity\Question
	 */
	public function create($question, $type = ObjectFactory::TEXT_QUESTION) {
        $questionObj = $this->objectFactory->createQuestion($type);
        $questionObj->setQuestion($question);
        $this->poll->addItem($questionObj);
        return $questionObj;
	}
	
	/**
	 * Remove a question from the service
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException
	 */
	public function delete(Question $question) {
        if (!$this->poll->hasItem($question)) {
            throw new QuestionDoesNotExistException("The removal of the question was unsuccessful.
                                                     The following question is not present in the Question Service.");
        }
        $this->poll->removeItem($question);
        return $question;
	}
	
	/**
	 * Update a question from the service
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException
	 */
	public function update(Question $question) {
        if (!$this->poll->hasItem($question)) {
            throw new QuestionDoesNotExistException("The removal of the question was unsuccessful.
                                                     The following question is not present in the Question Service.");
        }
        $old_question = $this->poll->getItem($question->getId());
        $this->poll->removeItem($old_question);
        $this->poll->addItem($question);
        return $question;
	}
	
	/**
	 * Add to question of type Option a choice
	 * @param \Poll\PollBundle\Entity\Choice\ChoiceQuestion $question otazka
	 * @param string $option text moznosti
	 * @param string $shared ma byt moznost sdilena mezi otazkami
	 * @param string $exclusive pokud ma byt sdilena, lze ji ve vsech otazkach vybrat vicekrat nebo jen jednou
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException pokud otazka neexistuje v ankete
	 */
	public function addOption(ChoiceQuestion $question, $option, $shared = false, $exclusive = false) {
        $questionObj = $this->find($question->getId());
        $optionObj = $this->objectFactory->createOption($shared);
        $questionObj->addOption($optionObj);
        return $optionObj;
	}
	
	/**
	 * Add existing Sharing option to a different question than the one where we originated.
     * Option when re-add remain in question only once.
	 * @param \Poll\PollBundle\Entity\Choice\ChoiceQuestion $question otazka
	 * @param \Poll\PollBundle\Entity\Choice\SharedOption $option moznost
	 * @throws \Poll\PollBundle\Exception\QuestionDoesNotExistException pokud otazka neexistuje v ankete
	 */
	public function addSharedOption(ChoiceQuestion $question, SharedOption $option) {
        $questionObj = $this->find($question->getId());
        $questionObj->addOption($option);
	}
	
	/**
	 * Remove an Option from the question
	 * @param \Poll\PollBundle\Entity\Choice\ChoiceQuestion $question
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @throws FIXME pokud otazka neexistuje v ankete
	 * @throws FIXME pokud moznost v otazce neexistuje
	 */
	public function removeOption(ChoiceQuestion $question, Option $option) {
		$questionObj = $this->find($question->getId());
        $questionObj->removeOption($option);
	}
}