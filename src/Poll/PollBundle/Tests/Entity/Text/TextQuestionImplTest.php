<?php
namespace Poll\PollBundle\Tests\Entity;

use Poll\PollBundle\Entity\PollItem;
use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;

class TextQuestionImplTest extends \PHPUnit_Framework_TestCase {

	protected $factory;

	public function setUp() {
		$this->factory = new LocalObjectFactory;
	}

	public function testInstantiation() {
		$object = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Text\TextQuestion',
				$object,
				'Trida neimplementuje rozhrani TextQuestion'
		);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Question',
				$object,
				'Trida neimplementuje rozhrani Question'
		);
		return $object;
	}

	/**
	 * @depends testInstantiation
	 */
	public function testAttributes($q) {
		$q1 = uniqid('question',TRUE);
		$q->setQuestion($q1);

		$this->assertEquals($q1,$q->getQuestion(),'Nastaveny a ziskany text otazky nejsou shodne');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testFluency($q) {
		$this->assertEquals($q,$q->setQuestion('question'),'Nefunguje fluent interface');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testType($q) {
		$this->assertEquals(PollItem::TYPE_SIMPLE,$q->getType(),'Otazka nema nastaveny typ anketni polozky');
	}

}