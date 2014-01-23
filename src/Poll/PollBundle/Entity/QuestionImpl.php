<?php
namespace Poll\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Service\ObjectFactory;

/**
 * Question implementation class
 * @author AnaBalica
 *
 * @ORM\Entity
 * @ORM\Table(name="Question")
 */
class QuestionImpl extends PollItemImpl implements Question {

	/** @var Collection */
	protected $items;

	/**
     * @ORM\Column(type="string", length=255)
     */
	protected $question;

    /**
     * @ORM\Column(name="question_type", type="integer")
     */
    protected $questionType;

    /**
     * @ORM\ManyToOne(targetEntity="PollImpl")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id")
     */
    protected $poll_id;

	public function __construct() {
		parent::__construct();
		$this->items = new Collection();
        $this->type = PollItem::TYPE_SIMPLE;
	}

    /**
     * Get question type
     * @return int
     */
    public function getQuestionType() {
        return $this->questionType;
    }

    public function setQuestionType($questionType) {
        $questionTyple = intval($questionType);
        if (in_array($questionType, array(
                ObjectFactory::TEXT_QUESTION,
                ObjectFactory::SINGLE_CHOICE_QUESTION,
                ObjectFactory::MULTIPLE_CHOICE_QUESTION))) {
            $this->questionType = $questionType;
        }
        else {
            throw new \Exception("Invalid question type.");
        }
    }

	/**
	 * Get the question string
	 * @return string
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Set the question string
	 * @param string $question
	 * @return Question
	 */
	public function setQuestion($question) {
		if (empty($question))
			throw new \Exception("The question cannot be empty. Please provide a string.");
		$this->question = $question;
		return $this;
	}

    /**
     * Get poll_id
     *
     * @return string
     */
    public function getPollId() {
        return $this->poll_id;
    }

    /**
     * Get poll_id
     *
     * @param string $poll_id
     * @return Poll\PollBundle\Entity\QuestionImpl
     */
    public function setPollId($poll_id) {
        $this->poll_id = $poll_id;
        return $this;
    }

	/**
	 * Add an answer to the question
	 * @param Answer $answer
	 * @return Question
	 */
	public function addAnswer(Answer $answer) {
		$this->items->addItem($answer, true);
		return $this;
	}

	/**
	 * Remove the answer from the questions
	 * @param Answer $answer
	 * @return Question
	 */
	public function removeAnswer(Answer $answer) {
		$this->items->removeItem($answer, true);
		return $this;
	}

	/**
	 * Get all the answers to the question
	 * @return array[Answer]
	 */
	public function getAnswers() {
		return $this->items->getItems();
	}

	/**
	 * Get an answer according to its id
	 * @param string $id
	 * @return Question
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id) {
		return $this->items->getItem($id);
	}

	/**
	 * Check if an answer is present
	 * @param Answer $answer
	 * @return boolean
	 */
	public function hasAnswer(Answer $answer) {
		return $this->items->hasItem($answer);
	}
}