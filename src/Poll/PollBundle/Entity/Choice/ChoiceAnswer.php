<?php
namespace Poll\PollBundle\Entity\Choice;

use Poll\PollBundle\Entity\Answer;

/**
 * Rozhrani pro odpoved na otazku s vyberem z moznosti
 * @author jirkovoj
 */
interface ChoiceAnswer extends Answer {

	/**
	 * @return Option|Options
	 */
	public function getAnswer();

}
