<?php
namespace Poll\PollBundle\Tests\Entity;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Exception\InvalidOptionException;

class MultipleChoiceAnswerImplTest extends \PHPUnit_Framework_TestCase {

	protected $factory;

	public function setUp() {
		$this->factory = new LocalObjectFactory;
	}

	public function testInstantiation() {
		$object = $this->factory->createAnswer(ObjectFactory::MULTIPLE_CHOICE_ANSWER);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Choice\MultipleChoiceAnswer',
				$object,
				'Trida neimplementuje rozhrani MultipleChoiceAnswer'
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
		$q = $this->factory->createQuestion(ObjectFactory::MULTIPLE_CHOICE_QUESTION);
		$a->setQuestion($q);

		$this->assertEquals($q,$a->getQuestion(),'Nastavena a ziskana otazka nejsou shodne');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testCollection($a) {
		$q = $this->factory->createQuestion(ObjectFactory::MULTIPLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$o2 = $this->factory->createOption(ObjectFactory::SHARED_OPTION);
		$q->addOption($o1);
		$q->addOption($o2);
		$a->setQuestion($q);
		$a->AddAnswerOption($o1);
		$a->AddAnswerOption($o2);

		$this->assertTrue($a->hasAnswerOption($o1),'Vlozena moznost nebyla nasledne nalezena');
		$this->assertTrue($a->hasAnswerOption($o2),'Vlozena moznost nebyla nasledne nalezena');
		$this->assertEquals($o1,$a->getAnswerOption($o1->getId()),'Vlozena a ziskana moznost nejsou shodne');
		$this->assertEquals($o2,$a->getAnswerOption($o2->getId()),'Vlozena a ziskana moznost nejsou shodne');

		$a->RemoveAnswerOption($o1);
		$a->RemoveAnswerOption($o2);

		$this->assertFalse($a->hasAnswerOption($o1),'Odstranena moznost je stale v odpovedi');
		$this->assertFalse($a->hasAnswerOption($o2),'Odstranena moznost je stale v odpovedi');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testConsistency($a) {
		$q = $this->factory->createQuestion(ObjectFactory::MULTIPLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$o2 = $this->factory->createOption(ObjectFactory::SHARED_OPTION);
		$a->setQuestion($q);
		$q->addOption($o1);
		// testuje, zda lze odpovedet jen moznosti, ktera byla v otazce
		try {
			$a->addAnswerOption($o2);
		} catch (InvalidOptionException $e) {}
		$this->assertFalse($a->hasAnswerOption($o2),'Do odpovedi byla vlozena moznost, ktera neni v otazce');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testInversion($a) {
		$q = $this->factory->createQuestion(ObjectFactory::MULTIPLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$a->setQuestion($q);
		$q->addOption($o1);
		$a->addAnswerOption($o1);

		$this->assertTrue($q->hasAnswer($a),'Nefunguje inverzni vazba mezi odpovedi a otazkou');
		$this->assertTrue($o1->hasAnswer($a),'Nefunguje inverzni vazba mezi odpovedi a moznosti');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testFluency($a) {
		$q = $this->factory->createQuestion(ObjectFactory::MULTIPLE_CHOICE_QUESTION);
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$q->addOption($o1);

		$this->assertEquals($a,$a->setQuestion($q),'Nefunguje fluent interface');
		$this->assertEquals($a,$a->addAnswerOption($o1),'Nefunguje fluent interface');
		$this->assertEquals($a,$a->removeAnswerOption($o1),'Nefunguje fluent interface');
	}

}