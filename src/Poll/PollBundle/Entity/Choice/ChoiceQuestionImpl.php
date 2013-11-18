<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\QuestionImpl;
use Poll\PollBundle\Common\Collection;

/**
 * Choice Question Implementation abstract class
 * Represents a question with multiple choice answers
 * @author AnaBalica
 */
abstract class ChoiceQuestionImpl extends QuestionImpl implements ChoiceQuestion {

	/**
	 * Add an answer option to collection of choices
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return \Poll\PollBundle\Entity\Choice\ChoiceQuestion
	 */
	public function addOption(Option $option) {
		$this->items->addItem($option, true);
		return $this;
	}

	/**
	 * Remove an answer option from the collection of choices
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return \Poll\PollBundle\Entity\Choice\ChoiceQuestion
	 */
	public function removeOption(Option $option) {
		$this->items->removeItem($option);
		return $this;
	}

	/**
	 * Get all the options
	 * @return array[\Poll\PollBundle\Entity\Choice\Option]
	 */
	public function getOptions() {
		return $this->items->getItems();
	}
	
	/**
	 * Get an option according to it's id
	 * @param mixed $id
	 * @return \Poll\PollBundle\Entity\Choice\Option
	 * @throws \Poll\PollBundle\Exception\ItemDoesNotExistException
	 */
	public function getOption($id) {
		return $this->items->getItem($id);
	}

	/**
	 * Check if an option is in the collection of choices
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return boolean
	 */
	public function hasOption(Option $option) {
		return $this->items->hasItem($option);
	}
}