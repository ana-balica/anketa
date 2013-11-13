<?php
namespace Poll\PollBundle\Tests\Service;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Exception\PollDoesNotExistException;

/**
 *
 * @author kadleto2
 */
class PollServiceTest extends \PHPUnit_Framework_TestCase {

	protected $objectFactory;

	protected $application;


	/* (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	protected function setUp() {
		$this->objectFactory = new LocalObjectFactory();
		$this->application = $this->objectFactory->createPollService();
	}

	public function testImplementation() {
		$this->assertInstanceOf(
				'\Poll\PollBundle\Service\PollService',
				$this->application,
				'Sluzba neimplementuje rozhrani PollService'
			);
	}

	public function testCreatePoll() {
		$this->application->create("Prvni anketa", "Testovaci anketa");
		/* @var $poll \Poll\PollBundle\Entity\Poll */
		$poll = $this->application->create("Druha anketa", "Testovaci anketa");
		$this->application->create("Treti anketa", "Testovaci anketa");
		$this->assertSame($this->application->find($poll->getId()), $poll, 'Vytvorena anketa nebyla nasledne nalezena');
	}

	public function testDeletePoll() {
		$poll = $this->application->create("Prvni anketa", "Testovaci anketa");
		$this->application->delete($poll);
		try {
			$this->application->find($poll->getId());
			$this->fail("Bylo ocekavano vyhozeni vyjimky.");
		} catch(PollDoesNotExistException $e) {
			$this->assertInstanceOf('\Poll\PollBundle\Exception\PollDoesNotExistException', $e);
		} catch(\Exception $e) {
			$this->fail("Bylo ocekavana vyjimka PollDoesNotExistException a nikoliv " .
					get_class($e) . ".");
		}
	}

	public function testFindSharedOptions() {
		$poll = $this->application->create("Prvni anketa", "Testovaci anketa");
		$qs = $this->application->getQuestionService($poll);
		$question_count = 4;
		$option_count = 3;

		for($j=0;$j<$option_count;$j++) {
			$option[$j] = $this->objectFactory->createOption(ObjectFactory::SHARED_OPTION);
			$option[$j]->setOption('Moznost '.$j);
		}

		for($i=0;$i<$question_count;$i++) {
			$question = $qs->create('Otazka '.$i.' - zvolte hodnoceni 1-3',ObjectFactory::SINGLE_CHOICE_QUESTION);
			for($j=0;$j<$option_count;$j++) {
				$qs->addSharedOption($question,$option[$j]);
			}
		}

		$options = $this->application->findSharedOptions($poll)->getItems();
		$this->assertEquals($option_count,count($options),'Pocet nalezenych sdilenych moznosti neodpovida');
		for($j=0;$j<$option_count;$j++) {
			$this->assertContains($option[$j],$options,'Nebyla nalezena sdilena moznost '.$j);
		}
	}

	public function testGetServices() {
		$poll = $this->application->create("Prvni anketa", "Testovaci anketa");

		$this->assertInstanceOf(
			'Poll\PollBundle\Service\QuestionService',
			$this->application->getQuestionService($poll),
			'Sluzba pro otazky neimplementuje rozhrani QuestionService'
		);
		$this->assertInstanceOf(
			'Poll\PollBundle\Service\AnswerService',
			$this->application->getAnswerService($poll),
			'Sluzba pro odpovedi neimplementuje rozhrani AnswerService'
		);
		$this->assertInstanceOf(
			'Poll\PollBundle\Service\GroupService',
			$this->application->getGroupService($poll),
			'Sluzba pro skupiny otazek neimplementuje rozhrani GroupService'
		);
	}

}
