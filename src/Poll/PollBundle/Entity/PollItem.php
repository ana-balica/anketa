<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\Identified;

/**
 * Entita polozka ankety
 * @author kadleto2
 */
interface PollItem extends Identified {
	
	const TYPE_SIMPLE = 0;
	const TYPE_STRUCTURED = 1;
	
	/**
	 * Vraci typ anketni polozky
	 */
	public function getType();
	
	/**
	 * Vrati anketu, do ktere polozka prislusi
	 * @return Poll
	 */
	public function getPoll();
	
	/**
	 * Nastavi anketu, do ktere anketa prislusi
	 * @param Poll $poll
	 * @return PollItem
	 */
	public function setPoll(Poll $poll);
	
}
