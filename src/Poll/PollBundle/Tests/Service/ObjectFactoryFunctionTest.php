<?php
namespace Poll\PollBundle\Tests\Service;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;

/**
 * 
 * @author kadleto2
 */
class ObjectFactoryTest extends \PHPUnit_Framework_TestCase {
	
	/** @var ObjectFactory */
	protected $factory;
	
	protected function setUp() {
		$this->factory = new LocalObjectFactory();
	}
	
	/**
	 * Overi, ze vytvorena instance je typu Poll
	 */
	public function testCreatePoll() {
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Poll", 
			$this->factory->createPoll(),
			'Vytvorena anketa neimplementuje rozhrani Poll'
		);
	}
	
	/**
	 * Overi, ze vytvorene instance jsou typu TextQuestion, SingleChoiceQuestion a MultipleChoiceQuestion
	 */
	public function testCreateQuestion() {
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Text\TextQuestion",
				$this->factory->createQuestion(ObjectFactory::TEXT_QUESTION),
				'Vytvorena textova otazka neimplementuje rozhrani TextQuestion'
			);
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Choice\SingleChoiceQuestion",
				$this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION),
				'Vytvorena vyberova otazka neimplementuje rozhrani SingleChoiceQuestion'
			);
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Choice\MultipleChoiceQuestion",
				$this->factory->createQuestion(ObjectFactory::MULTIPLE_CHOICE_QUESTION),
				'Vytvorena vyberova otazka neimplementuje rozhrani MultipleChoiceQuestion'
			);
	}
	
	/**
	 * Overi, ze vytvorene instance jsou typy SharedOption nebo UnsharedOption
	 */
	public function testCreateOption() {
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Choice\SharedOption",
				$this->factory->createOption(ObjectFactory::SHARED_OPTION),
				'Vytvorena sdilena moznost neimplementuje rozhrani SharedOption'
			);
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Choice\UnsharedOption",
				$this->factory->createOption(ObjectFactory::UNSHARED_OPTION),
				'Vytvorena nesdilena moznost neimplementuje rozhrani UnsharedOption'
			);
	}
	
	/**
	 * Overi, ze vytvorene instance jsou typu TextAnswer, SingleChoiceAnswer a MultipleChoiceAnswer
	 */
	public function testCreateAnswer() {
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Text\TextAnswer",
				$this->factory->createAnswer(ObjectFactory::TEXT_ANSWER),
				'Vytvorena textova odpoved neimplementuje rozhrani TextAnswer'
			);
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Choice\SingleChoiceAnswer",
				$this->factory->createAnswer(ObjectFactory::SINGLE_CHOICE_ANSWER),
				'Vytvorena vyberova odpoved neimplementuje rozhrani SingleChoiceAnswer'
			);
		$this->assertInstanceOf("\Poll\PollBundle\Entity\Choice\MultipleChoiceAnswer",
				$this->factory->createAnswer(ObjectFactory::MULTIPLE_CHOICE_ANSWER),
				'Vytvorena vyberova odpoved neimplementuje rozhrani MultipleChoiceAnswer'
			);
	}
	
	/**
	 * Overi, ze vytvorena instance je typu PollService
	 */
	public function testCreatePollService() {
		$this->assertInstanceOf("\Poll\PollBundle\Service\PollService", 
				$this->factory->createPollService(),
				'Vytvorena sluzba pro ankety neimplementuje rozhrani PollService'
			);
	}

}