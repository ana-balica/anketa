<?php

namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\Answer;

class MultipleChoiceQuestionImpl extends ChoiceQuestionImpl implements MultipleChoiceQuestion {

	/**
	 * 
	 * @return string
	 */
	public function getQuestion() {

	}

	/**
	 * 
	 * @param string $question
	 * @return Question
	 */
	public function setQuestion($question) {

	}

	/**
	 * 
	 * @param Answer $answer
	 * @return Question
	 */
	public function addAnswer(Answer $answer) {

	}

	/**
	 * 
	 * @param Answer $answer
	 * @return Question
	 */
	public function removeAnswer(Answer $answer) {

	}

	/**
	 * 
	 * @return array[Answer]
	 */
	public function getAnswers() {

	}

	/**
	 * 
	 * @param string $id
	 * @return Question
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id) {

	}

	/**
	 * 
	 * @param Answer $answer
	 * @return boolean
	 */
	public function hasAnswer(Answer $answer) {

	}
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