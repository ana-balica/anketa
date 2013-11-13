<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Group;
use Poll\PollBundle\Entity\Choice\Option;
use Poll\PollBundle\Entity\Choice\SharedOption;
use Poll\PollBundle\Entity\Choice\ChoiceQuestion;

/**
 * Rozhrani pro praci se skupinami otazek
 * (volitelna vlastnost)
 *
 * @author kadleto2
 */
interface GroupService {

	/**
	 * Vrati anketu, pro kterou je sluzba platna
	 * @return Poll
	 */
	public function getPoll();

	public function create($title, $description);

	public function addQuestion(Group $group,Question $question);

	public function removeQuestion(Group $group,Question $question);

}