<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Entity\Choice\Option;
use Poll\PollBundle\Entity\Choice\SharedOption;
use Poll\PollBundle\Entity\Choice\ChoiceQuestion;
use Poll\PollBundle\Entity\Text\TextQuestion;
use Poll\PollBundle\Entity\Respondent;

/**
 * Obsluha anketnich polozek konkretni ankety
 *
 * @author kadleto2
 */
interface AnswerService {

	/**
	 * Vrati anketu, pro kterou je sluzba platna
	 * @return Poll
	 */
	public function getPoll();

	/**
	 * Vytvori odpoved podle typu otazky
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @param \Poll\PollBundle\Entity\Respondent $respondent
	 * @return \Poll\PollBundle\Entity\Answer
	 */
	public function create(Question $question, Respondent $respondent);

	/**
	 * Najde odpoved podle jejiho id
	 * @param number $id
	 * @throws \Poll\PollBundle\Exception\AnswerDoesNotExistException
	 */
	public function find($id);

	/**
	 * nastavi hodnotu odpovedi (text, moznost) nebo prida moznost (pro MultipleChoiceAnswer)
	 * @param \Poll\PollBundle\Entity\Answer
	 * @param mixed - string | \Poll\PollBundle\Entity\Choice\Option
	 * @return \Poll\PollBundle\Entity\Answer
	 */
	public function setAnswer(Answer $answer, $value);
}