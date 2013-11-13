<?php
namespace Poll\PollBundle\Tests\Service;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Exception\QuestionDoesNotExistException;

/**
 *
 * @author jirkovoj
 */
class QuestionServiceTest extends \PHPUnit_Framework_TestCase {

	protected $objectFactory;
	
	protected $service;

	protected function setUp() {
		$this->objectFactory = new LocalObjectFactory();
		$application = $this->objectFactory->createPollService();
		$poll = $application->create("Prvni anketa", "Testovaci anketa");
		$this->service = $application->getQuestionService($poll);
	}

	public function testImplementation() {
		$this->assertInstanceOf(
			'\Poll\PollBundle\Service\QuestionService',
			$this->service,
			'Trida neimplementuje rozhrani QuestionService'
		);
	}
	
	public function testGetPoll() {
		$this->assertInstanceOf(
			'\Poll\PollBundle\Entity\Poll',
			$this->service->getPoll(),
			'Pripojena anketa neimplementuje rozhrani Poll'
		);
	}
	
	public function testCreateQuestion() {
		$this->service->create("Prvni otazka");
		/* @var $poll \Poll\PollBundle\Entity\Poll */
		$question = $this->service->create("Druha otazka");
		$this->service->create("Treti otazka");
		$this->assertSame($this->service->find($question->getId()), $question, 'Vlozena otazka nebyla nasledne nalezena');
	}

	public function testDeleteQuestion() {
		$question = $this->service->create("Prvni otazka");
		$this->service->delete($question);
		try {
			$this->service->find($question->getId());
			$this->fail("Exception expected but none has been thrown.");
		} catch(QuestionDoesNotExistException $e) {}
	}

	public function testOptions() {
		$question = $this->service->create("Prvni otazka",ObjectFactory::SINGLE_CHOICE_QUESTION);
		$o1 = $this->objectFactory->createOption(ObjectFactory::SHARED_OPTION);
		$o1->setOption('Moznost 1');
		$this->service->addSharedOption($question,$o1);
		$o2 = $this->service->addOption($question,'Moznost 2');
		
		$this->assertEquals($o1,$question->getOption($o1->getId()),'Vlozena moznost nebyla nasledne nalezena');
		$this->assertEquals($o2,$question->getOption($o2->getId()),'Vlozena moznost nebyla nasledne nalezena');
		
		$this->service->removeOption($question,$o1);
		$this->service->removeOption($question,$o2);
		
		$this->assertFalse($question->hasOption($o1),'Odstranena moznost je stale v otazce');
		$this->assertFalse($question->hasOption($o2),'Odstranena moznost je stale v otazce');
	}

}