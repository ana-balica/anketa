<?php
namespace Poll\PollBundle\Tests\Entity;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;

class TextAnswerImplTest extends \PHPUnit_Framework_TestCase {

	protected $factory;

	public function setUp() {
		$this->factory = new LocalObjectFactory;
	}

	public function testInstantiation() {
		$object = $this->factory->createAnswer(ObjectFactory::TEXT_ANSWER);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Text\TextAnswer',
				$object,
				'Trida neimplementuje rozhrani TextAnswer'
		);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Answer',
				$object,
				'Trida neimplementuje rozhrani Answer'
		);
		return $object;
	}

	/**
	 * @depends testInstantiation
	 */
	public function testAttributes($a) {
		$a1 = uniqid('answer',TRUE);
		$q = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);
		$a->setAnswer($a1);
		$a->setQuestion($q);

		$this->assertEquals($a1,$a->getAnswer(),'Nastaveny a ziskany text odpovedi nejsou shodne');
		$this->assertEquals($q,$a->getQuestion(),'Nastavena a ziskana otazka nejsou shodne');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testInversion($a) {
		$a1 = uniqid('answer',TRUE);
		$q = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);
		$a->setAnswer($a1);
		$a->setQuestion($q);

		$this->assertTrue($q->hasAnswer($a),'Nefunguje inverzni vazba mezi odpovedi a otazkou');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testFluency($a) {
		$q = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);

		$this->assertEquals($a,$a->setAnswer('answer'),'Nefunguje fluent interface');
		$this->assertEquals($a,$a->setQuestion($q),'Nefunguje fluent interface');
	}

}