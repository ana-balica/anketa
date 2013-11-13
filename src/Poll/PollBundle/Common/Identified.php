<?php
namespace Poll\PollBundle\Common;

/**
 * Rozhrani povinne pro kazdy identifikovatelny objekt
 * 
 * @author kadleto2
 */
interface Identified {

	/**
	 * @return string identifikator objektu
	 */
	public function getId();

}
