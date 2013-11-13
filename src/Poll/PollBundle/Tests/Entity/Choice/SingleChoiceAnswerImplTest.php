<?php
namespace Poll\PollBundle\Tests\Entity;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Exception\InvalidOptionException;

class SingleChoiceAnswerImplTest extends \PHPUnit_Framework_TestCase {

	protected $factory;

	public function setUp() {
		$this->factory = new LocalObjectFactory;
	}

	public function testInstantiation() {
		$object = $this->factory->createAnswer(ObjectFactory::SINGLE_CHOICE_ANSWER);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Choice\SingleChoiceAnswer',
				$object,
				'Trida neimplementuje rozhrani SingleChoiceAnswer'
		);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Choice\ChoiceAnswer',
				$object,
				'Trida neimplementuje rozhrani ChoiceAnswer'
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
	public function testId($a) {
		$id = $a->getId();
		$this->assertFalse($id == '' || $id == NULL,'Instance nema nastavene Id');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testAttributes($a) {
		$q = $this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$o2 = $this->factory->createOption(ObjectFactory::SHARED_OPTION);
		$q->addOption($o1);
		$q->addOption($o2);
		$a->setQuestion($q);
		$a->setAnswer($o1);

		$this->assertEquals($q,$a->getQuestion(),'Nastavena a ziskana otazka nejsou shodne');
		$this->assertEquals($o1,$a->getAnswer(),'Nastavena a ziskana moznost nejsou shodne');

		$a->setAnswer($o2);

		$this->assertEquals($o2,$a->getAnswer(),'Nastavena a ziskana moznost nejsou shodne');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testConsistency($a) {
		$q = $this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$o2 = $this->factory->createOption(ObjectFactory::SHARED_OPTION);
		$a->setQuestion($q);
		$q->addOption($o1);
		// testuje, zda lze odpovedet jen moznosti, ktera byla v otazce
		try {
			$a->setAnswer($o2);
		} catch (InvalidOptionException $e) {}
		$this->assertFalse($o2 === $a->getAnswer(),'Do odpovedi byla vlozena moznost, ktera neni v otazce');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testInversion($a) {
		$q = $this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$a->setQuestion($q);
		$q->addOption($o1);
		$a->setAnswer($o1);

		$this->assertTrue($q->hasAnswer($a),'Nefunguje inverzni vazba mezi odpovedi a otazkou');
		$this->assertTrue($o1->hasAnswer($a),'Nefunguje inverzni vazba mezi odpovedi a moznosti');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testFluency($a) {
		$q = $this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$q->addOption($o1);

		$this->assertEquals($a,$a->setQuestion($q),'Nefunguje fluent interface');
		$this->assertEquals($a,$a->setAnswer($o1),'Nefunguje fluent interface');
	}
	
	/**
	 * @expectedException \Poll\PollBundle\Exception\IncompatibleClassException
	 */
	public function testCompatibility() {
		$answer = $this->factory->createAnswer(ObjectFactory::SINGLE_CHOICE_ANSWER);
		$question = $this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION);
		$answer->setQuestion($question);
		$this->assertSame($question, $answer->getQuestion());
		$question = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);
		$answer->setQuestion($question);
	}

}