<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\PollItem;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Choice\Option;
use Poll\PollBundle\Entity\Answer;

/**
 * Rozhrani objektove tovarny, ktera centralizuje mapovani mezi jednotlivymi
 * rozhranimi a jejich implementacemi.
 * 
 * Implementace tohoto rozhrani ma povinny nazev!!!
 * \Poll\PollBudle\Service\ServiceImpl\LocalObjectFactory
 *
 * @author kadleto2
 */
interface ObjectFactory {

	const TEXT_QUESTION = 1;
	const SINGLE_CHOICE_QUESTION = 2;
	const MULTIPLE_CHOICE_QUESTION = 3;

	const SHARED_OPTION = true;
	const UNSHARED_OPTION = false;

	const TEXT_ANSWER = 1;
	const SINGLE_CHOICE_ANSWER = 2;
	const MULTIPLE_CHOICE_ANSWER = 3;

	const QUESTION_GROUP = 4;

	/**
	 * Vytvori novou anketu
	 * @return Poll
	 */
	public function createPoll();

	/**
	 * Vytvori novou skupinu otazek
	 * @return Group
	 */
	public function createGroup();

	/**
	 * Vytvori otazku pozadovaneho typu. Viz konstanty TEXT_QUESTION,
	 * SINGLE_CHOICE_QUESTION, MULTIPLE_CHOICE_QUESTION
	 * @param number $type
	 * @return Question
	 */
	public function createQuestion($type = self::TEXT_QUESTION);

	/**
	 * Vytvori novou moznost pozadovaneho typu. Viz konstanty SHARED_OPTION
	 * a UNSHARED_OPTION
	 * @param number $type
	 * @return Option
	 */
	public function createOption($type = self::UNSHARED_OPTION);

	/**
	 * Vytvori odpoved pozadovaneho typu. Viz konstanty TEXT_ANSWER,
	 * SINGLE_CHOICE_ANSWER, MULTIPLE_CHOICE_ANSWER
	 * @param number $type
	 * @return Question
	 */
	public function createAnswer($type = self::TEXT_ANSWER);

	/**
	 * Vytvori sluzbu pro spravu anket
	 * @return \Poll\PollBundle\Service\PollService
	 */
	public function createPollService();

	/**
	 * Vytvori sluzbu pro spravu anketnich otazek v ramci jedne ankety
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Service\QuestionService
	 */
	public function createQuestionService(Poll $poll);

	/**
	 * Vytvori sluzbu pro spravu odpovedi na anketni otazky
	 * v ramci zvolene ankety
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Service\AnswerService
	 */
	public function createAnswerService(Poll $poll);

	/**
	 * Vytvori sluzbu pro spravu anketnich polozek v ramci jedne ankety
	 * @param \Poll\PollBundle\Entity\Poll $poll
	 * @return \Poll\PollBundle\Service\GroupService
	 * @throws \LogicException pokud neni sluzba implementovana
	 */
	public function createGroupService(Poll $poll);

}