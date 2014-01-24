<?php
namespace Poll\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Poll\PollBundle\Common\IdentifiedClass;
use Poll\PollBundle\Exception\IncompatibleClassException;
use Poll\PollBundle\Service\ObjectFactory;
use Poll\PollBundle\Entity\Choice\OptionImpl;

/**
 * Abstract implementation of Answer class
 *
 * @author AnaBalica
 *
 * @ORM\Entity
 * @ORM\Table(name="Answer")
 */
class AnswerImpl extends IdentifiedClass implements Answer {

    /**
     * @ORM\Column(name="answer_type", type="integer")
     */
    protected $answerType;

    /**
     * @ORM\Column(name="answer_text", type="text")
     */
    protected $answerText;

    /** @var Respondent */
	protected $respondent;

    /**
     * @ORM\ManyToOne(targetEntity="QuestionImpl")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id", onDelete="CASCADE")
     */
	protected $question;

    /**
     * @ORM\ManyToOne(targetEntity="PollImpl")
     *  @ORM\JoinColumn(name="poll_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $poll;

    /**
     * @ORM\ManyToMany(targetEntity="Poll\PollBundle\Entity\Choice\OptionImpl")
     * @ORM\JoinTable(name="Answers_Options",
     *      joinColumns={@ORM\JoinColumn(name="answer_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="option_id", referencedColumnName="id")}
     *      )
     */
    protected $options;

    public function __construct() {
        parent::__construct();
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
    }
	/**
	 * Get the respondent of the answer
	 * @return Respondent
	 */
	public function getRespondent() {
		return $this->respondent;
	}

	/**
	 * Set the respondent of the answer
	 * @param Respondent $respondent
	 */
	public function setRespondent(Respondent $respondent) {
		$this->respondent = $respondent;
	}

	/**
	 * Get the initial question
	 * @return \Poll\PollBundle\Entity\Question
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Set the question
	 * @param Question $question
	 * @return \Poll\PollBundle\Entity\Answer
	 * @throws \LogicException pokud trida/rozhrani, se kterou je odpoved kompatibilni, neexistuje
	 * @throws IncompatibleClassException otazka neni kompatibilni s touto odpovedi
	 */
	public function setQuestion(Question $question) {
        if ($question instanceof \Question)
            throw new \LogicException("The question param should implement Question interface");

        $implemented_interfaces = class_implements(get_class($question));
        if (!in_array($this::COMPATIBLE_QUESTION, $implemented_interfaces))
            throw new IncompatibleClassException("The answer and the question are not compatible");
        $this->question = $question;
        $this->question->addAnswer($this);
		return $this;
	}

    public function setQuestionEntity(Question $question) {
        $this->question = $question;
        return $this;
    }

    /**
     * Set answerType
     *
     * @param integer $answerType
     * @return AnswerImpl
     */
    public function setAnswerType($answerType)
    {
        $this->answerType = $answerType;
        return $this;
    }

    /**
     * Get answerType
     *
     * @return integer 
     */
    public function getAnswerType()
    {
        return $this->answerType;
    }

    /**
     * Set answerText
     *
     * @param string $answerText
     * @return AnswerImpl
     */
    public function setAnswerText($answerText)
    {
        $this->answerText = $answerText;
        return $this;
    }

    /**
     * Get answerText
     *
     * @return string 
     */
    public function getAnswerText()
    {
        return $this->answerText;
    }

    /**
     * Set poll
     *
     * @param \Poll\PollBundle\Entity\PollImpl $poll
     * @return AnswerImpl
     */
    public function setPoll(PollImpl $poll)
    {
        $this->poll = $poll;
        return $this;
    }

    /**
     * Get poll
     *
     * @return \Poll\PollBundle\Entity\PollImpl 
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * Add options
     *
     * @param \Poll\PollBundle\Entity\Choice\OptionImpl $options
     * @return AnswerImpl
     */
    public function addOption(OptionImpl $options)
    {
        $this->options[] = $options;
    
        return $this;
    }

    /**
     * Remove options
     *
     * @param \Poll\PollBundle\Entity\Choice\OptionImpl $options
     */
    public function removeOption(OptionImpl $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOptions()
    {
        return $this->options;
    }
}