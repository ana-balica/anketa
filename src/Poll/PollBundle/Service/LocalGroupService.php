<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Group;

class LocalGroupService implements GroupService {

	/** @var Poll $poll */
	protected $poll;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

	/**
	* 
	* @return Poll
	*/
	public function getPoll() {

	}

	public function create($title, $description) {

	}

	public function addQuestion(Group $group, Question $question) {

	}

	public function removeQuestion(Group $group, Question $question) {

	}
}