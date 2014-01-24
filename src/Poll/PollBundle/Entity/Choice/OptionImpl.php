<?php
namespace Poll\PollBundle\Entity\Choice;

use Doctrine\ORM\Mapping as ORM;
use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Common\Collection;
use Poll\PollBundle\Entity\QuestionImpl;
use Poll\PollBundle\Entity\PollImpl;

/**
 * Class OptionImpl
 * An option to a question from a pool of answers
 * @package Poll\PollBundle\Entity\Choice
 *
 * @ORM\Entity
 * @ORM\Table(name="`Option`")
 */
class OptionImpl extends IdentifiedClass implements Option {

	/**
     * @ORM\Column(name="option_text", type="string", length=255)
     */
	protected $option;

    /** @var Collection */
    protected $questions;

    /** @var Collection */
    protected $answers;

    /**
     * @ORM\Column(name="is_exclusive", type="boolean", nullable=True)
     */
    protected $exclusive;

    /**
     * @ORM\Column(name="is_shared", type="boolean", nullable=True)
     */
    protected $isShared;

    /**
     * @ORM\ManyToOne(targetEntity="Poll\PollBundle\Entity\QuestionImpl")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $question;

    /**
     * @ORM\ManyToOne(targetEntity="Poll\PollBundle\Entity\PollImpl")
     * @ORM\JoinColumn(name="poll_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $poll;

    public function __construct() {
        parent::__construct();
        $this->questions = new Collection();
        $this->answers = new Collection();
    }

	/**
	 * Get the option
	 * @return string
	 */
	public function getOption() {
		return $this->option;
	}

	/**
	 * Set the option
	 * @param string $option
	 * @return Option
	 */
	public function setOption($option) {
		$this->option = $option;
		return $this;
	}

    /**
     * Get the option type (shared or unshared)
     * @return bool true if shared option, false otherwise
     */
    public function isShared() {
        return $this->isShared;
    }

	/**
	 * Add questions
     * This is a reciprocal relationship between options and questions
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function addQuestion(ChoiceQuestion $question) {
        $this->questions->addItem($question);
        return $this;
	}

	/**
	 * Remove questions
     * This is a reciprocal relationship between options and questions
	 * @param ChoiceQuestion $question
	 * @return Option
	 */
	public function removeQuestion(ChoiceQuestion $question) {
        $this->questions->removeItem($question);
        return $this;
	}

	/**
	 * Get all questions
	 * @return array[Question]
	 */
	public function getQuestions() {
        return $this->questions->getItems();
	}

	/**
	 * Get a question according to its id
	 * @param mixed $id
	 * @return ChoiceQuestion
	 * @throws ItemDoesNotExistException
	 */
	public function getQuestion($id) {
        return $this->questions->getItem($id);
	}

	/**
	 * Check if the Option has a specific question
	 * @param ChoiceQuestion $question
	 * @return boolean
	 */
	public function hasQuestion(ChoiceQuestion $question) {
        return $this->questions->hasItem($question);
	}

	/**
	 * Add an answer
     * This is a reciprocal relationship between options and questions
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function addAnswer(ChoiceAnswer $answer) {
        $this->answers->addItem($answer);
        return $answer->getQuestion();
	}

	/**
	 * Remove an answer
     * This is a reciprocal relationship between options and questions
	 * @param MultipleChoiceAnswer $answer
	 * @return ChoiceQuestion
	 */
	public function removeAnswer(ChoiceAnswer $answer) {
        $this->answers->removeItem($answer);
        return $answer->getQuestion();
	}

	/**
	 * Get all answers
	 * @return array[Answer]
	 */
	public function getAnswers() {
        return $this->answers->getItems();
	}

	/**
	 * Get an answer according to its id
	 * @param mixed $id
	 * @return Answer
	 * @throws ItemDoesNotExistException
	 */
	public function getAnswer($id) {
        return $this->answers->getItem($id);
	}

	/**
	 * Check if an answer is present
	 * @param ChoiceAnswer $answer
	 * @return boolean
	 */
	public function hasAnswer(ChoiceAnswer $answer) {
        return $this->answers->hasItem($answer);
	}

	/**
	 * Get if exclusive
	 * @return true the option is exclusive to the poll / group of questions
	 */
	public function getExclusive() {
        return $this->exclusive;
	}

	/**
	 * Set exclusivity
	 * @param boolean $exclusive
	 * @return Option
	 */
	public function setExclusive($exclusive = False) {
	    $this->exclusive = $exclusive;
        return $this;
	}

    /**
     * Set isShared
     *
     * @param boolean $isShared
     * @return OptionImpl
     */
    public function setIsShared($isShared = False){
        $this->isShared = $isShared;
        return $this;
    }

    /**
     * Get isShared
     *
     * @return boolean
     */
    public function getIsShared(){
        return $this->isShared;
    }

    /**
     * Set question
     *
     * @param \Poll\PollBundle\Entity\QuestionImpl $question
     * @return OptionImpl
     */
    public function setQuestion(QuestionImpl $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Set poll
     *
     * @param \Poll\PollBundle\Entity\QuestionImpl $poll
     * @return OptionImpl
     */
    public function setPoll(PollImpl $poll)
    {
        $this->poll = $poll;

        return $this;
    }

    /**
     * Get poll
     *
     * @return \Poll\PollBundle\Entity\QuestionImpl
     */
    public function getPoll()
    {
        return $this->poll;
    }
}