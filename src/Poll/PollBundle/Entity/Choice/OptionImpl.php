<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Common\IdentifiedClass;

abstract class OptionImpl extends IdentifiedClass implements Option {

	/** @var string */
	protected $option;

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
	 * 
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function addQuestion(ChoiceQuestion $question) {

	}

	/**
	 * 
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function removeQuestion(ChoiceQuestion $question) {

	}

	/**
	 * 
	 * @return array[Option]
	 */
	public function getQuestions() {

	}

	/**
	 * 
	 * @param mixed $id
	 * @return ChoiceQuestion
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id) {

	}

	/**
	 * 
	 * @param ChoiceQuestion $question
	 * @return boolean
	 */
	public function hasQuestion(ChoiceQuestion $question) {

	}

	/**
	 * 
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function addAnswer(ChoiceAnswer $answer) {

	}

	/**
	 * 
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function removeAnswer(ChoiceAnswer $answer) {

	}

	/**
	 * 
	 * @return array[Answer]
	 */
	public function getAnswers() {

	}

	/**
	 * 
	 * @param mixed $id
	 * @return Answer
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id) {

	}

	/**
	 * 
	 * @param ChoiceAnswer $answer
	 * @return boolean
	 */
	public function hasAnswer(ChoiceAnswer $answer) {

	}
	
	/**
	 * 
	 * @return true pokud je moznost exkluzivni pro anketu / skupinu otazek
	 */
	public function getExclusive() {

	}
	
	/**
	 * 
	 * @param boolean $exclusive
	 * @return Option
	 */
	public function setExclusive($exclusive) {
		
	}
}