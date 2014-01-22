<?php
namespace Poll\PollBundle\Common;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unikatne identifikovatelny objekt
 *
 * @author kadleto2
 *
 * @MappedSuperclass
 */
abstract class IdentifiedClass implements Identified {

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	protected $id;

	/**
	 * Zajistuje prirazeni unikatniho id pri vytvoreni objektu
	 */
	public function __construct() {
		$this->id = uniqid();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Poll\PollBundle\Common\Identified::getId()
	 */
	public function getId() {
		return $this->id;
	}

}
