<?php
namespace Poll\PollBundle\Tests\Entity;

use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;

class PollImplTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->factory = new LocalObjectFactory;
	}

	public function testInstantiation() {
		/** @var PollImpl */
		$object = $this->factory->createPoll();
		$this->assertInstanceOf(
				'\Poll\PollBundle\Entity\Poll',
				$object,
				'Trida neimplementuje rozhrani Poll'
		);
		return $object;
	}

	/**
	 * @depends testInstantiation
	 */
	public function testAttributes($p) {
		$t = uniqid('title',TRUE);
		$d = uniqid('description',TRUE);
		$p->setTitle($t);
		$p->setDescription($d);

		$this->assertEquals($t,$p->getTitle(),'Nastaveny a ziskany nadpis nejsou shodne');
		$this->assertEquals($d,$p->getDescription(),'Nastaveny a ziskany popis nejsou shodne');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testCollection($p) {
		$q1 = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);
		$p->addItem($q1);

		$this->assertTrue($p->hasItem($q1),'Vlozena otazka nebyla nasledne nalezena');
		$this->assertEquals($q1,$p->getItem($q1->getId()),'Vlozena a ziskana otazka nejsou shodne');

		$p->removeItem($q1);

		$this->assertFalse($p->hasItem($q1),'Odstranena otazka je stale v ankete');
	}

	/**
	 * @depends testInstantiation
	 */
	public function testFluency($p) {
		$q1 = $this->factory->createQuestion(ObjectFactory::TEXT_QUESTION);

		$this->assertEquals($p,$p->addItem($q1),'Nefunguje fluent interface');
		$this->assertEquals($p,$p->setTitle('title'),'Nefunguje fluent interface');
		$this->assertEquals($p,$p->setDescription('description'),'Nefunguje fluent interface');
	}

}