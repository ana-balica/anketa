<?php
namespace Poll\PollBundle\Entity\Text;

use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Entity\Question;

/**
 * Rozhrani pro textovou odpoved
 * @author kadleto2
 */
interface TextAnswer extends Answer {
	
	/**
	 * Resi nemoznost dale specializovat rozhrani pomoci type hinting
	 * @var string
	 */
	const COMPATIBLE_QUESTION = '\Poll\PollBundle\Entity\Text\TextQuestion';

	/**
	 * Vrati textovou odpoved 
	 * @return string
	 */
	public function getAnswer();

	/**
	 * Nastavi textovou odpoved
	 * @param string $anwser
	 * @return TextAnswer
	 */
	public function setAnswer($answer);

}
