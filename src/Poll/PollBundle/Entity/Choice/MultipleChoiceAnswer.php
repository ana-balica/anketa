<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Exception\ItemDoesNotExistException;

/**
 * Rozhrani pro odpoved otazku s vyberem z moznosti, 
 * odpovedi muze byt vice vybranych moznosti
 * @author kadleto2
 */
interface MultipleChoiceAnswer extends ChoiceAnswer {

	/**
	 * Resi nemoznost dale specializovat rozhrani pomoci type hinting
	 * @var string
	 */
	const COMPATIBLE_QUESTION = 'Poll\PollBundle\Entity\Choice\MultipleChoiceQuestion';

	/**
	 * prida zvolenou moznost do kolekce odpovedi
	 * @param Option $option
	 * @return MultipleChoiceQuestion
	 */
	public function addAnswerOption(Option $option);

	/**
	 * odebere zvolenou moznost z kolekce odpovedi
	 * @param Option $option
	 * @return ChoiceQuestion
	 */
	public function removeAnswerOption(Option $option);

	/**
	 * vrati pole zvolenych moznosti
	 * @return array[Option]
	 */
	public function getAnswer();

	/**
	 * vrati jednotlivou polozku z kolekce odpovedi
	 * @param mixed $id
	 * @return Option
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswerOption($id);

	/**
	 * zjisti zda je moznost v kolekci odpovedi
	 * @param Option $option
	 * @return boolean
	 */
	public function hasAnswerOption(Option $option);

}
