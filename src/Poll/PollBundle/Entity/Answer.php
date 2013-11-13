<?php
namespace Poll\PollBundle\Entity;

use Poll\PollBundle\Common\Identified;
use Poll\PollBundle\Exception\IncompatibleClassException;

/**
 * Rozhrani pro odpoved na otazku - spolecna cast
 * @author jirkovoj
 */
interface Answer extends Identified {
	
	/**
	 * Vrati respondenta
	 * @return Respondent
	 */
	public function getRespondent();

	/**
	 * Nastavi respondenta
	 * @param Respondent $respondent
	 */
	public function setRespondent(Respondent $respondent);

	/**
	 * Vrati otazku, ke ktere se tato odpoved vztahuje
	 * @return \Poll\PollBundle\Entity\Question
	 */
	public function getQuestion();

	/**
	 * Metoda resi na zaklade konstanty potomka compatibleClass
	 * kontrolu, zda je predany datovy typ spravny (nejen Question,
	 * ale konkretni Question napr. TextQuestion).
	 * @param Question $question
	 * @return \Poll\PollBundle\Entity\Answer
	 * @throws \LogicException pokud trida/rozhrani, se kterou je odpoved kompatibilni, neexistuje
	 * @throws IncompatibleClassException otazka neni kompatibilni s touto odpovedi
	 */
	public function setQuestion(Question $question);

}
