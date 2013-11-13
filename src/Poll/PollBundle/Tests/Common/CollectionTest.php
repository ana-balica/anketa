<?php
namespace Poll\PollBundle\Tests\Common;

use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Entity\Text\TextQuestionImpl;
use Poll\PollBundle\Exception\ItemAlreadyExistsException;
use Poll\PollBundle\Exception\ItemDoesNotExistException;

/**
 * 
 * @author kadleto2
 */
class CollectionTest extends \PHPUnit_Framework_TestCase {
	
	protected static $i1;
	protected static $i2;
	protected static $i3;
	
	public static function setUpBeforeClass() {
		self::$i1 = new IdentifiedClassImpl();
		self::$i2 = new IdentifiedClassImpl();
		self::$i3 = new IdentifiedClassImpl();
	}

	public function testInstantiation() {
		/** @var IdentifiedClass */
		$object = new Collection();
		$this->assertInstanceOf(
				'\Poll\PollBundle\Common\Collection',
				$object,
				'Instance neni od spravne tridy nebo neni ve spravnem namespacu');
		
		return $object;
	}
	
	/**
	 * @depends testInstantiation
	 */
	public function testAddItem(Collection $collection) {
		$collection->addItem(self::$i1);
		$collection->addItem(self::$i2);
		$this->assertTrue($collection->hasItem(self::$i1),'Vlozena polozka do kolekce v ni nasledne nebyla nalezena');
		$this->assertTrue($collection->hasItem(self::$i2),'Vlozena polozka do kolekce v ni nasledne nebyla nalezena');
		$this->assertFalse($collection->hasItem(self::$i3),'Vlozena polozka do kolekce v ni nasledne nebyla nalezena');
		return $collection;
	}
	
	/**
	 * @depends testAddItem
	 * @param Collection $collection
	 */
	public function testAddItemStrict(Collection $collection) {
		try {
			$collection->addItem(self::$i1, true);
		} catch (ItemAlreadyExistsException $e) {
			return;
		} catch (\Exception $e) {
			$this->unexpectedException($e);
		}
		$this->fail("Exception expected but none has been thrown.");
	}

	/**
	 * @depends testAddItem
	 * @param Collection $collection
	 */
	public function testGetItem(Collection $collection) {
		try {
			$i1 = $collection->getItem(self::$i1->getId());
			$this->assertSame($i1, self::$i1,'Vlozena a ziskana polozka nejsou shodne');
		} catch (\Exception $e) {
			$this->unexpectedException($e);
		}
		try {
			$i3 = $collection->getItem(self::$i3->getId());
		} catch (ItemDoesNotExistException $e) {
			;
		} 
		catch (\Exception $e) {
			$this->unexpectedException($e);
		}
		return $collection;
	}
	
	/**
	 * @depends testAddItem
	 * @param Collection $collection
	 */
	public function testRemoveItem(Collection $collection) {
		try {
			$collection->removeItem(self::$i1);
			$this->assertFalse($collection->hasItem(self::$i1),'Odstranena polozka je stale v kolekci');
			$collection->removeItem(self::$i1);
		} catch (\Exception $e) {
			$this->unexpectedException($e);
		}
		try {
			$collection->removeItem(self::$i1, true);
		} catch (ItemDoesNotExistException $e) {
			return ;
		} catch (\Exception $e) {
			$this->unexpectedException($e);
		}
		$this->fail("Exception expected but none has been thrown.");
	}
	
	protected function unexpectedException(\Exception $e) {
		$this->fail("Unexpected exception of class ".get_class($e).
				" has been thrown. Message: " . $e->getMessage());
	}
}
