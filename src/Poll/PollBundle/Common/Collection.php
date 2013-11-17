<?php
namespace Poll\PollBundle\Common;

use Poll\PollBundle\Exception\ItemDoesNotExistException;
use Poll\PollBundle\Exception\ItemAlreadyExistsException;
/**
 * Kolekce objektu. 
 * Jeji prvky museji implementovat rozhrani Identified.
 * @author jirkovoj
 */
class Collection extends IdentifiedClass {


	/** @var array[] */
	protected $items;

	/**
	 * Vlozeni objektu do kolekce
	 * @param Identified $item objekt
	 * @param boolean $strict pokud je true a objekt je jiz v kolekci, je vyhozena vyjimka
	 * @return Collection
	 * @throws ItemAlreadyExistsException
	 */
	public function addItem(Identified $item, $strict = false) {
		if ($strict && $this->hasItem($item))
			throw new ItemAlreadyExistsException();
		$this->items[$item->getId()] = $item;
		return $this;
	}

	/**
	 * Odebrani objektu z kolekce
	 * @param Identified $item objekt
	 * @param boolean $strict pokud je true a objekt v kolekci neexistuje, je vyhozena vyjimka
	 * @return Collection
	 * @throws ItemDoesNotExistException
	 */
	public function removeItem(Identified $item, $strict = false) {
		if (!$this->hasItem($item) && $strict) {
			throw new ItemDoesNotExistException();
		}
		unset($this->items[$item->getId()]);
		return $this;
	}

	/**
	 * Vraci prvky kolekce jako pole
	 * @return array[]
	 */
	public function getItems() {
		return $this->items;
	}

	/**
	 * Najde prvek v kolekci a vrati jej
	 * @param mixed $id
	 * @return Identified
	 * @throws ItemDoesNotExistException pokud prvek neexistuje
	 */
	public function getItem($id) {
		if ($this->isItem($id))
			return $this->items[$id];
		throw new ItemDoesNotExistException();
	}

	/**
	 * Overi, ze prvek v kolekci existuje
	 * @param Identified $item
	 * @return boolean
	 */
	public function hasItem(Identified $item) {
		return ($this->isItem($item->getId())
			&& $item === $this->items[$item->getId()]);
	}

	/**
	 * @param mixed $id
	 */
	protected function isItem($id) {
		return isset($this->items[$id]);
	}
}
