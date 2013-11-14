<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\QuestionImpl;

abstract class ChoiceQuestionImpl extends QuestionImpl implements ChoiceQuestion {

	/** @var Collection */
	protected $items;

	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return \Poll\PollBundle\Entity\Choice\ChoiceQuestion
	 */
	public function addOption(Option $option) {

	}

	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return \Poll\PollBundle\Entity\Choice\ChoiceQuestion
	 */
	public function removeOption(Option $option) {

	}

	/**
	 * 
	 * @return array[\Poll\PollBundle\Entity\Choice\Option]
	 */
	public function getOptions() {

	}
	
	/**
	 * 
	 * @param mixed $id
	 * @return \Poll\PollBundle\Entity\Choice\Option
	 * @throws \Poll\PollBundle\Exception\ItemDoesNotExistException
	 */
	public function getOption($id) {

	}

	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return boolean
	 */
	public function hasOption(Option $option) {
		
	}
}