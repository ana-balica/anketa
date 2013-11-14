<?php
namespace Poll\PollBundle\Entity;

class GroupImpl extends PollItemImpl implements Group {

	/** @var Collection */
	protected $items;

	/**
	 * 
	 * @param Question $question
	 * @return Group
	 */
	public function addQuestion(Question $question) {

	}

	/**
	 * 
	 * @param Question $question
	 * @return Group
	 */
	public function removeQuestion(Question $question) {

	}

	/**
	 * 
	 * @return array[Question]
	 */
	public function getQuestions() {

	}

	/**
	 * 
	 * @param mixed $id
	 * @return Question
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id) {

	}

	/**
	 * 
	 * @param Question $question
	 * @return boolean
	 */
	public function hasQuestion(Question $question) {

	}

	/**
	 * 
	 * @return string
	 */
	public function getTitle() {

	}

	/**
	 * 
	 * @param string $title
	 * @return Group
	 */
	public function setTitle($title) {

	}

	/**
	 * Vrati popis skupiny
	 * @return string
	 */
	public function getDescription() {

	}
	
	/**
	 * 
	 * @param string $description
	 * @return Group
	 */
	public function setDescription($description) {
		
	}
}