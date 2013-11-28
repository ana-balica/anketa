<?php
namespace Poll\PollBundle\Service;

use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Service\ServiceImpl\LocalObjectFactory;
use Poll\PollBundle\Entity\Answer;
use Poll\PollBundle\Entity\Poll;
use Poll\PollBundle\Entity\Question;
use Poll\PollBundle\Entity\Respondent;
use Poll\PollBundle\Exception\AnswerDoesNotExistException;
use Symfony\Component\Config\Definition\Exception\Exception;

class LocalAnswerService implements AnswerService {

	/** @var Poll $poll */
	protected $poll;

	/** @var ObjectFactory $objectFactory */
	protected $objectFactory;

    /** @var  Collection $answers  */
    protected $answers;

    /**
     * LocalAnswerService constructor
     */
    public function __construct(Poll $poll, LocalObjectFactory $objectFactory) {
        $this->poll = $poll;
        $this->objectFactory = $objectFactory;
        $this->answers = new Collection();
    }

    /**
	 * Get the poll object
	 * @return Poll
	 */
	public function getPoll() {
        return $this->poll;
	}

	/**
	 * Create a reply according to the type of question
	 * @param \Poll\PollBundle\Entity\Question $question
	 * @param \Poll\PollBundle\Entity\Respondent $respondent
	 * @return \Poll\PollBundle\Entity\Answer
	 */
	public function create(Question $question, Respondent $respondent) {
        $answer = $this->objectFactory->createAnswer($question->getType());
        $answer->setRespondent($respondent);
        $answer->setQuestion($question);
        $this->answers->addItem($answer);
        return $answer;
	}

	/**
	 * Find the answer according to its id
	 * @param number $id
     * @return Answer
	 * @throws \Poll\PollBundle\Exception\AnswerDoesNotExistException
	 */
	public function find($id) {
        try {
            return $this->answers->getItem($id);
        } catch (Exception $e) {
            throw new AnswerDoesNotExistException("An answer by this id doesn't exist");
        }
	}

	/**
	 * Set the value of the response (text option), or add options (for MultipleChoiceAnswer)
	 * @param \Poll\PollBundle\Entity\Answer
	 * @param mixed - string | \Poll\PollBundle\Entity\Choice\Option
	 * @return \Poll\PollBundle\Entity\Answer
	 */
	public function setAnswer(Answer $answer, $value) {
        if (is_string($value))
            $answer->setAnswer($value);
        else
            $answer->addAnswerOption($value);
	}
}