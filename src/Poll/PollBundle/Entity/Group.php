<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Exception\ItemDoesNotExistException;

/**
 * Rozhrani entity Group - skupina otazek
 * @author kadleto2
 */
interface Group extends PollItem {

	/**
	 * Prida otazku
	 * @param Question $question
	 * @return Group
	 */
	public function addQuestion(Question $question);

	/**
	 * Odebere otazku
	 * @param Question $question
	 * @return Group
	 */
	public function removeQuestion(Question $question);

	/**
	 * Vrati pole otazek
	 * @return array[Question]
	 */
	public function getQuestions();

	/**
	 * Nalezne otazku podle id
	 * @param mixed $id
	 * @return Question
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id);

	/**
	 * Overi, ze otazka je ve skupine
	 * @param Question $question
	 * @return boolean
	 */
	public function hasQuestion(Question $question);

	/**
	 * Vrati nazev skupiny
	 * @return string
	 */
	public function getTitle();

	/**
	 * Nastavi nazev skupiny
	 * @param string $title
	 * @return Group
	 */
	public function setTitle($title);

	/**
	 * Vrati popis skupiny
	 * @return string
	 */
	public function getDescription();
	
	/**
	 * Nastavi popis skupiny
	 * @param string $description
	 * @return Group
	 */
	public function setDescription($description);

}