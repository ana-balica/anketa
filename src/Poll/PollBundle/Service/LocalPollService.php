<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;

class LocalPollService implements PollService {

	/** @var Collection */
	protected $items;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

	/**
	 * 
	 * @param number $id
	 * @return \Poll\PollBundle\Entity\Poll
	 * @throws \Poll\PollBundle\Exception\PollDoesNotExistException 
	 */
	public function find($id) {

	}
	
	/**
	 * 
	 * @param string $title nazev ankety (nemusi byt unikatni, dokonce muze byt prazdny)
	 * @param string $description doplnujici popis (muze byt prazdny)
	 * @return \Poll\PollBundle\Entity\Poll
	 */
	public function create($title = null, $description = null) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Entity\Poll $poll
	 * @throws \Poll\PollBundle\Exception\PollDoesNotExistException
	 */
	public function delete(Poll $poll) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Entity\Poll
	 * @throws \Poll\PollBundle\Exception\PollDoesNotExistException
	 */
	public function update(Poll $poll) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Poll $poll 
	 * @return Collection
	 */
	public function findSharedOptions(Poll $poll) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 */
	public function getQuestionService(Poll $poll) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 */
	public function getAnswerService(Poll $poll) {

	}
	
	/**
	 * 
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \LogicException pokud neni sluzba implementovana
	 */
	public function getGroupService(Poll $poll) {

	}
}