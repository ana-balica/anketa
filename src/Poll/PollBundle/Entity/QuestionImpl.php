<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\Collection;

/**
 * Question implementation class
 * @author AnaBalica
 */
abstract class QuestionImpl extends PollItemImpl implements Question {

	/** @var Collection */
	protected $items;

	/** @var string */
	protected $question;

    /** @var  int */
    protected $questionType;

	public function __construct() {
		parent::__construct();
		$this->items = new Collection();
        $this->type = PollItem::TYPE_SIMPLE;
	}

    /**
     * Get question type
     * @return int
     */
    public function getQuestionType() {
        return $this->questionType;
    }

	/**
	 * Get the question string
	 * @return string
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Set the question string
	 * @param string $question
	 * @return Question
	 */
	public function setQuestion($question) {
		if (empty($question))
			throw new \Exception("The question cannot be empty. Please provide a string.");
		$this->question = $question;
		return $this;
	}

	/**
	 * Add an answer to the question
	 * @param Answer $answer
	 * @return Question
	 */
	public function addAnswer(Answer $answer) {
		$this->items->addItem($answer, true);
		return $this;
	}

	/**
	 * Remove the answer from the questions
	 * @param Answer $answer
	 * @return Question
	 */
	public function removeAnswer(Answer $answer) {
		$this->items->removeItem($answer, true);
		return $this;
	}

	/**
	 * Get all the answers to the question
	 * @return array[Answer]
	 */
	public function getAnswers() {
		return $this->items->getItems();
	}

	/**
	 * Get an answer according to its id
	 * @param string $id
	 * @return Question
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id) {
		return $this->items->getItem($id);
	}

	/**
	 * Check if an answer is present
	 * @param Answer $answer
	 * @return boolean
	 */
	public function hasAnswer(Answer $answer) {
		return $this->items->hasItem($answer);
	}
}