<?php
namespace Poll\PollBundle\Tests\Service;

use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;

/**
 * Overi existenci pozadovane factory tridy pro instanciaci trid
 * @author kadleto2
 */
class ObjectFactoryExistenceTest extends \PHPUnit_Framework_TestCase {
	
	public function testObjectService() {
		$this->assertTrue(class_exists("\Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory"),'Trida LocalObjectFactory neexistuje');
		$this->assertTrue(is_subclass_of(
				"\Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory",
				"\Poll\PollBundle\Service\ObjectFactory"),'Trida LocalObjectFactory neimplementuje rozhrani ObjectFactory');
	}
		
	
}
