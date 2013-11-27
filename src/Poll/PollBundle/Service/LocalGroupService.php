<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Group;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;

class LocalGroupService implements GroupService {

	/** @var Poll $poll */
	protected $poll;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

    public function __construct(Poll $poll, LocalObjectFactory $objectFactory) {
        $this->poll = $poll;
        $this->objectFactory = $objectFactory;
    }

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