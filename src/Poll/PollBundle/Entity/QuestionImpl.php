<?php
namespace Poll\PollBundle\Entity;

abstract class QuestionImpl extends PollItemImpl implements Question {

	/** @var Collection */
	protected $items;

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
	 * Overi, ze mezi odpovedmi je i odpoved
	 * @param Answer $answer
	 * @return boolean
	 */
	public function hasAnswer(Answer $answer) {
		
	}
}