<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\PollImpl;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Exception\PollDoesNotExistException;

/**
 * Class LocalPollService
 * @package Poll\PollBundle\Service
 */
class LocalPollService implements PollService {

	/** @var Collection */
	protected $items;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

    public function __construct(LocalObjectFactory $objectFactory) {
        $this->items = new Collection();
        $this->objectFactory = $objectFactory;
    }

	/**
	 * Find a poll according to its id
	 * @param number $id
	 * @return \Poll\PollBundle\Entity\Poll
	 * @throws \Poll\PollBundle\Exception\PollDoesNotExistException 
	 */
	public function find($id) {
        try {
            return $this->items->getItem($id);
        } catch (\Exception $e) {
            throw new PollDoesNotExistException("A poll with the following id doesn't exist");
        }
    }
	
	/**
	 * Create a new poll
	 * @param string $title nazev ankety (nemusi byt unikatni, dokonce muze byt prazdny)
	 * @param string $description doplnujici popis (muze byt prazdny)
	 * @return \Poll\PollBundle\Entity\Poll
	 */
	public function create($title = null, $description = null) {
        $poll = $this->objectFactory->createPoll();
        $poll->setTitle($title);
        $poll->setDescription($description);
        $this->items->addItem($poll);
        return $poll;
	}
	
	/**
	 * Remove a poll from the pool of pols
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Entity\Poll $poll
	 * @throws \Poll\PollBundle\Exception\PollDoesNotExistException
	 */
	public function delete(Poll $poll) {
        if (!$this->items->hasItem($poll)) {
            throw new PollDoesNotExistException("The removal of the poll was unsuccessful.
                                                 The following poll is not present in the Poll Service.");
        }
        $this->items->removeItem($poll);
        return $poll;
	}
	
	/**
	 * Update a pool from the service
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Entity\Poll
	 * @throws \Poll\PollBundle\Exception\PollDoesNotExistException
	 */
	public function update(Poll $poll) {
        if (!$this->items->hasItem($poll)) {
            throw new PollDoesNotExistException("The update of the poll was unsuccessful.
                                                 The following poll is not present in the Poll Service");
        }
        $old_poll = $this->items->getItem($poll->getId());
        $this->items->removeItem($old_poll);
        $this->items->addItem($poll);
        return $poll;
	}
	
	/**
	 * Find all the shared options using a "container" - in this case
     * the survey, but not in the assigned groups of questions
	 * @param \Poll\PollBundle\Entity\Poll $poll 
	 * @return Collection
	 */
	public function findSharedOptions(Poll $poll) {

	}
	
	/**
	 * Creates a service to work with questions of some specific poll
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 */
	public function getQuestionService(Poll $poll) {
        return $this->objectFactory->createQuestionService($poll);
	}
	
	/**
	 * Create a service to work with answers of some specific poll
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 */
	public function getAnswerService(Poll $poll) {
        return $this->objectFactory->createAnswerService($poll);
	}
	
	/**
	 * Create a service to work with groups of questions
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \LogicException pokud neni sluzba implementovana
	 */
	public function getGroupService(Poll $poll) {
        return $this->objectFactory->createGroupService($poll);
	}
}