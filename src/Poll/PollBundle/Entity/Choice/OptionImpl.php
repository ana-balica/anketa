<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Common\Collection;

/**
 * Class OptionImpl
 * An option to a question from a pool of answers
 * @package Poll\PollBundle\Entity\Choice
 */
abstract class OptionImpl extends IdentifiedClass implements Option {

	/** @var string */
	protected $option;

    /** @var Collection */
    protected $questions;

    /** @var Collection */
    protected $answers;

    /** @var boolean */
    protected $exclusive;

    public function __construct() {
        parent::__construct();
        $this->questions = new Collection();
        $this->answers = new Collection();
    }

	/**
	 * Get the option
	 * @return string
	 */
	public function getOption() {
		return $this->option;
	}

	/**
	 * Set the option
	 * @param string $option
	 * @return Option
	 */
	public function setOption($option) {
		$this->option = $option;
		return $this;
	}

	/**
	 * Add questions
     * This is a reciprocal relationship between options and questions
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function addQuestion(ChoiceQuestion $question) {
        $this->questions->addItem($question);
        return $this;
	}

	/**
	 * Remove questions
     * This is a reciprocal relationship between options and questions
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function removeQuestion(ChoiceQuestion $question) {
        $this->questions->removeItem($question);
        return $this;
	}

	/**
	 * Get all questions
	 * @return array[Question]
	 */
	public function getQuestions() {
        return $this->questions->getItems();
	}

	/**
	 * Get a question according to its id
	 * @param mixed $id
	 * @return ChoiceQuestion
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id) {
        return $this->questions->getItem($id);
	}

	/**
	 * Check if the Option has a specific question
	 * @param ChoiceQuestion $question
	 * @return boolean
	 */
	public function hasQuestion(ChoiceQuestion $question) {
        return $this->questions->hasItem($question);
	}

	/**
	 * Add an answer
     * This is a reciprocal relationship between options and questions
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function addAnswer(ChoiceAnswer $answer) {
        $this->answers->addItem($answer);
        return $answer->getQuestion();
	}

	/**
	 * Remove an answer
     * This is a reciprocal relationship between options and questions
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function removeAnswer(ChoiceAnswer $answer) {
        $this->answers->removeItem($answer);
        return $answer->getQuestion();
	}

	/**
	 * Get all answers
	 * @return array[Answer]
	 */
	public function getAnswers() {
        return $this->answers->getItems();
	}

	/**
	 * Get an answer according to its id
	 * @param mixed $id
	 * @return Answer
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id) {
        return $this->answers->getItem($id);
	}

	/**
	 * Check if an answer is present
	 * @param ChoiceAnswer $answer
	 * @return boolean
	 */
	public function hasAnswer(ChoiceAnswer $answer) {
        return $this->answers->hasItem($answer);
	}

	/**
	 * Get if exclusive
	 * @return true the option is exclusive to the poll / group of questions
	 */
	public function getExclusive() {
        return $this->exclusive;
	}

	/**
	 * Set exclusivity
	 * @param boolean $exclusive
	 * @return Option
	 */
	public function setExclusive($exclusive) {
	    $this->exclusive = $exclusive;
        return $this;
	}
}