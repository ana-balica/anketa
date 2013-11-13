<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Common\Identified;
use Poll\PollBundle\Exception\ItemDoesNotExistException;

/**
 * Rozhrani pro moznost
 * @author jirkovoj
 */
interface Option extends Identified {

	/**
	 * Vrati text moznosti
	 * @return string
	 */
	public function getOption();

	/**
	 * Nastavi text moznosti
	 * @param string $option
	 * @return Option
	 */
	public function setOption($option);

	/**
	 * Prida otazku, v pripade sdilene moznosti jich muze byt vice
	 * (druha strana vztahu otazka - moznost, ktery muze byt m:n)
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function addQuestion(ChoiceQuestion $question);

	/**
	 * Prida otazku, v pripade sdilene moznosti jich muze byt vice
	 * (druha strana vztahu otazka - moznost, ktery muze byt m:n)
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function removeQuestion(ChoiceQuestion $question);

	/**
	 * Vrati pole otazek, ve kterych je moznost pouzita
	 * (druha strana vztahu otazka - moznost, ktery muze byt m:n)
	 * @return array[Option]
	 */
	public function getQuestions();

	/**
	 * Najde otazku podle id mezi temi, do kterych moznost patri
	 * @param mixed $id
	 * @return ChoiceQuestion
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id);

	/**
	 * Zjisti, zda je moznost pouzita v otazce 
	 * @param ChoiceQuestion $question
	 * @return boolean
	 */
	public function hasQuestion(ChoiceQuestion $question);

	/**
	 * Prida odpoved, ktera zvolila tuto moznost
	 * (pozor, v pripade sdilene moznosti jde o vztah m:n)
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function addAnswer(ChoiceAnswer $answer);

	/**
	 * Odebere odpoved, ktera zvolila tuto moznost
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function removeAnswer(ChoiceAnswer $answer);

	/**
	 * Vrati odpovedi, ktere zvolily tuto moznost
	 * @return array[Answer]
	 */
	public function getAnswers();

	/**
	 * Najde odpoved, ktera zvolila tuto moznost podle id
	 * @param mixed $id
	 * @return Answer
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id);

	/**
	 * Zjisti, jesli je odpoved mezi temi, co zvolily tuto moznost
	 * @param ChoiceAnswer $answer
	 * @return boolean
	 */
	public function hasAnswer(ChoiceAnswer $answer);
	
	/**
	 * Zjisti, zda je moznost exkluzivni, tj. je sdilena, ale zvolit 
	 * ji lze pouze v jedne z otazek, kam je zarazena
	 * @return true pokud je moznost exkluzivni pro anketu / skupinu otazek
	 */
	public function getExclusive();
	
	/**
	 * Nastavi priznak otazky, ze je exkluzivni.
	 * @param boolean $exclusive
	 * @return Option
	 */
	public function setExclusive($exclusive);
}
