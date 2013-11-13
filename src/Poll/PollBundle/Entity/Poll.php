<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Common\Identified;
use Poll\PollBundle\Exception\ItemDoesNotExistException;

/**
 * Entita Anketa
 * @author jirkovoj
 */
interface Poll extends Identified {

	/**
	 * Prida otazku ci skupinu otazek, pokud uz existuje
	 * @param Poll\PollBundle\Entity\PollItem $item
	 * @return Poll\PollBundle\Entity\Poll
	 */
	public function addItem(PollItem $item);

	/**
	 * Odebere otazku ci skupinu otazek
	 * @param Poll\PollBundle\Entity\PollItem $item
	 * @return Poll\PollBundle\Entity\Poll
	 */
	public function removeItem(PollItem $item);

	/**
	 * Vrati vsechny polozky ankety jako pole
	 * @return array[PollItem]
	 */
	public function getItems();

	/**
	 * Najde polozku ankety podle id
	 * @param mixed $id
	 * @return Poll\PollBundle\Entity\PollItem
	 * @throws ItemDoesNotExistException pokud polozka neexistuje
	 */
	public function getItem($id);

	/**
	 * Overi, ze polozka existuje
	 * @param Poll\PollBundle\Entity\PollItem $item
	 * @return boolean
	 */
	public function hasItem(PollItem $item);

	/**
	 * Vrati nazev ankety
	 * @return string
	 */
	public function getTitle();

	/**
	 * Nastavi nazev ankety
	 * @param string $title
	 * @return Poll\PollBundle\Entity\Poll
	 */
	public function setTitle($title);

	/**
	 * Vrati popisek ankety
	 * @return string
	 */
	public function getDescription();

	/**
	 * Nastavi popisek ankety
	 * @param string $description
	 * @return Poll\PollBundle\Entity\Poll
	 */
	public function setDescription($description);

}
