<?php
namespace Poll\PollBundle\Tests\Entity;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Entity\PollItem;

class SingleChoiceQuestionImplTest extends \PHPUnit_Framework_TestCase {

	protected $factory;

	public function setUp() {
		$this->factory = new LocalObjectFactory;
	}

	public function testInstantiation() {
		$object = $this->factory->createQuestion(ObjectFactory::SINGLE_CHOICE_QUESTION);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Choice\SingleChoiceQuestion',
				$object);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Choice\ChoiceQuestion',
				$object);
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Question',
				$object);
		return $object;
	}

	/**
	 * @depends testInstantiation
	 */
	public function testId($q) {
		$id = $q->getId();
		$this->assertFalse($id == '' || $id == NULL,'Instance nema nastavene Id');
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
	public function testColleciton($q) {
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$o2 = $this->factory->createOption(ObjectFactory::SHARED_OPTION);
		$q->addOption($o1);
		$q->addOption($o2);

		$this->assertTrue($q->hasOption($o1),'Vlozena moznost nebyla nasledne nalezena');
		$this->assertTrue($q->hasOption($o2),'Vlozena moznost nebyla nasledne nalezena');
		$this->assertEquals($o1,$q->getOption($o1->getId()),'Vlozena a ziskana moznost nejsou shodne');
		$this->assertEquals($o2,$q->getOption($o2->getId()),'Vlozena a ziskana moznost nejsou shodne');

		$q->removeOption($o1);
		$q->removeOption($o2);

		$this->assertFalse($q->hasOption($o1),'Odstranena moznost je stale v otazce');
		$this->assertFalse($q->hasOption($o2),'Odstranena moznost je stale v otazce');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testInversion($q) {
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);
		$q->addOption($o1);

		$this->assertTrue($o1->hasQuestion($q),'Nefunguje inverzni vazba mezi otazkou a moznosti');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testFluency($q) {
		$o1 = $this->factory->createOption(ObjectFactory::UNSHARED_OPTION);

		$this->assertEquals($q,$q->setQuestion('question'),'Nefunguje fluent interface');
		$this->assertEquals($q,$q->addOption($o1),'Nefunguje fluent interface');
		$this->assertEquals($q,$q->removeOption($o1),'Nefunguje fluent interface');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testType($q) {
		$this->assertEquals(PollItem::TYPE_SIMPLE,$q->getType(),'Otazka nema nastaveny typ anketni polozky');
	}

}