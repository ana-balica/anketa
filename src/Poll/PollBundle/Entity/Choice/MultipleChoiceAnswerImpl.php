<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Common\Collection;

/**
 * Implementation of MultipleChoiseAnswer interface
 * Represents a multiple choice answer - could be one single answer or more
 * @author AnaBalica
 */
class MultipleChoiceAnswerImpl extends ChoiceAnswerImpl implements MultipleChoiceAnswer {

	/** @var Collection */
	protected $answers;

	public function __construct() {
		parent::__construct();
		$this->answers = new Collection();
	}

    /**
	 * Get the answer
	 * @return array of Option
	 */
	public function getAnswer() {
		return $this->answers->getItems();
	}

	/**
	 * Add an option to the collection of answers
	 * @param Option $option
	 * @return MultipleChoiceQuestion
	 */
	public function addAnswerOption(Option $option) {
		$this->answers->addItem($option);
		return $this;
	}

	/**
	 * Remove an option from the collection of answers
	 * @param Option $option
	 * @return ChoiceQuestion
	 */
	public function removeAnswerOption(Option $option) {
		$this->answers->removeItem($option);
		return $this;
	}

	/**
	 * Check if an option is in the collection according to its id
	 * @param mixed $id
	 * @return Option
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswerOption($id) {
		return $this->answers->getItem($id);
	}

	/**
	 * Check if an option is in the collection
	 * @param Option $option
	 * @return boolean
	 */
	public function hasAnswerOption(Option $option) {
		return $this->answers->hasItem($option);
	}
}