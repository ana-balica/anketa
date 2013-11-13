<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Exception\ItemDoesNotExistException;

/**
 * Rozhrani pro otazku s vyberem z moznosti
 * @author kadleto2
 */
interface ChoiceQuestion extends Question {

	/**
	 * Prida moznost
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return \Poll\PollBundle\Entity\Choice\ChoiceQuestion
	 */
	public function addOption(Option $option);

	/**
	 * Odebere moznost
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return \Poll\PollBundle\Entity\Choice\ChoiceQuestion
	 */
	public function removeOption(Option $option);

	/**
	 * Vrati pole moznosti
	 * @return array[\Poll\PollBundle\Entity\Choice\Option]
	 */
	public function getOptions();
	
	/**
	 * Najde moznost dle id
	 * @param mixed $id
	 * @return \Poll\PollBundle\Entity\Choice\Option
	 * @throws \Poll\PollBundle\Exception\ItemDoesNotExistException
	 */
	public function getOption($id);

	/**
	 * Zjisti, zda otazka ma danou moznost
	 * @param \Poll\PollBundle\Entity\Choice\Option $option
	 * @return boolean
	 */
	public function hasOption(Option $option);

}
