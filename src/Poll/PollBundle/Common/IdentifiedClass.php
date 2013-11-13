<?php
namespace Poll\PollBundle\Common;

/**
 * Unikatne identifikovatelny objekt
 *
 * @author kadleto2
 */
abstract class IdentifiedClass implements Identified {

	/** @var string $id */
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
