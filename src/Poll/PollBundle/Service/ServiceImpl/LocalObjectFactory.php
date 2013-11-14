<?php
namespace Poll\PollBundle\Service\ServiceImpl;

use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\PollItem;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Entity\PollImpl;
use Poll\PollBundle\Entity\PollItemImpl;
use Poll\PollBundle\Entity\Text\TextQuestionImpl;
use Poll\PollBundle\Entity\Choice\SingleChoiceQuestionImpl;
use Poll\PollBundle\Entity\Choice\SingleChoiceAnswerImpl;
use Poll\PollBundle\Entity\Choice\MultipleChoiceQuestionImpl;
use Poll\PollBundle\Entity\Choice\MultipleChoiceAnswerImpl;
use Poll\PollBundle\Entity\Choice\UnsharedOptionImpl;
use Poll\PollBundle\Entity\Choice\SharedOptionImpl;
use Poll\PollBundle\Entity\Text\TextAnswerImpl;
use Poll\PollBundle\Entity\GroupImpl;
use Poll\PollBundle\Service\LocalPollService;
use Poll\PollBundle\Service\ObjectFactory;


/**
 * Interface pro vytvareni objektu
 *
 * @author kadleto2
 */
class LocalObjectFactory implements ObjectFactory {

	/**
	 * Vytvori novou anketu
	 * @return Poll
	 */
	public function createPoll() {
		return new PollImpl();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Poll\PollBundle\Service\ObjectFactory::createGroup()
	 */
	public function createGroup() {
		return new GroupImpl();
	}

	/**
	 * (non-PHPdoc)
	 * @see \Poll\PollBundle\Service\ObjectFactory::createQuestion()
	 */
	public function createQuestion($type = self::TEXT_QUESTION) {
		switch ($type) {
			case self::TEXT_QUESTION:
				return new TextQuestionImpl();
			case self::SINGLE_CHOICE_QUESTION:
				return new SingleChoiceQuestionImpl();
			case self::MULTIPLE_CHOICE_QUESTION:
				return new MultipleChoiceQuestionImpl();
			default:
				throw new \LogicException("Unsupported question type $type.");
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see \Poll\PollBundle\Service\ObjectFactory::createOption()
	 */
	public function createOption($type = self::UNSHARED_OPTION) {
		switch ($type) {
			case self::UNSHARED_OPTION:
				return new UnsharedOptionImpl();
			case self::SHARED_OPTION:
				return new SharedOptionImpl();
			default:
				throw new \LogicException("Unsupported option type $type.");
		}
	}

	/**
	 * Vytvori odpoved pozadovaneho typu. Viz konstanty TEXT_ANSWER,
	 * SINGLE_CHOICE_ANSWER, MULTIPLE_CHOICE_ANSWER
	 * @param number $type
	 * @return Question
	 */
	public function createAnswer($type = self::TEXT_ANSWER) {
		switch ($type) {
			case self::TEXT_ANSWER:
				return new TextAnswerImpl();
			case self::SINGLE_CHOICE_ANSWER:
				return new SingleChoiceAnswerImpl();
			case self::MULTIPLE_CHOICE_ANSWER:
				return new MultipleChoiceAnswerImpl();
			default:
				throw new \LogicException("Unsupported answer type $type.");
		}
	}

	public function createPollService() {
		return new LocalPollService($this);
	}

	/**
	 * @see \Poll\PollBundle\Service\ObjectFactory::createQuestionService()
	 */
	public function createQuestionService(Poll $poll) {
		return new LocalQuestionService($poll, $this);
	}

	/**
	 * @see \Poll\PollBundle\Service\ObjectFactory::createAnswerService()
	 */
	public function createAnswerService(Poll $poll) {
		return new LocalAnswerService($poll, $this);

	}

	/**
	 * @see \Poll\PollBundle\Service\ObjectFactory::createGroupService()
	 */
	public function createGroupService(Poll $poll) {
		return new LocalGroupService($poll, $this);
	}

}