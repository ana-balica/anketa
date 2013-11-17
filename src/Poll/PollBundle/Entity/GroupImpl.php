<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\Collection;

/**
 * Group of Questions class
 * @author AnaBalica
 */
class GroupImpl extends PollItemImpl implements Group {

	/** @var Collection */
	protected $items;

	/** @var string */
	protected $title;

	/** @var string */
	protected $description;

	public function __construct() {
		parent::__construct();
		$this->items = Collection();
	}

	/**
	 * Add a question to the group
	 * @param Question $question
	 * @return Group
	 */
	public function addQuestion(Question $question) {
		$this->items->addItem($question, true);
		return $this;
	}

	/**
	 * Remove the question from the group
	 * @param Question $question
	 * @return Group
	 */
	public function removeQuestion(Question $question) {
		$this->items->removeItem($question, true);
		return $this;
	}

	/**
	 * Get all the questions from the group
	 * @return array[Question]
	 */
	public function getQuestions() {
		return $this->items;
	}

	/**
	 * Get a question according to its $id
	 * @param mixed $id
	 * @return Question
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id) {
		return $this->items->getItem($id);
	}

	/**
	 * Check if a question is in the group
	 * @param Question $question
	 * @return boolean
	 */
	public function hasQuestion(Question $question) {
		return $this->items->hasItem($question);
	}

	/**
	 * Get the title of the group
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set the title of the group
	 * @param string $title
	 * @return Group
	 */
	public function setTitle($title) {
		if (empty($title))
			throw new Exception("The title of the group cannot be empty. Please provide a valid string.");
		$this->title = $title;
		return $this;
	}

	/**
	 * Get the description of the group
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Set the description of the group
	 * @param string $description
	 * @return Group
	 */
	public function setDescription($description) {
		if (!isset($description))
			throw new Exception("The description of the group should be a string.");
		$this->description = $description;
		return $this;
	}
}