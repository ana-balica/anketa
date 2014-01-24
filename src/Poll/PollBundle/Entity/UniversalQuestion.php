<?php
namespace Poll\PollBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Poll\PollBundle\Common\IdentifiedClass;

/**
 * A universal question implementation class used as a form entity
 * for rendering and collecting information to and from forms
 * @author AnaBalica
 *
 * @ORM\Entity
 */
class UniversalQuestion extends IdentifiedClass {

    /**
     * @ORM\Column(type="integer")
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $question;

    /**
     * @ORM\Column(type="text")
     */
    protected $options;

    /**
     * Set type
     *
     * @param integer $type
     * @return UniversalQuestion
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set question
     *
     * @param string $question
     * @return UniversalQuestion
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set options
     *
     * @param string $options
     * @return UniversalQuestion
     */
    public function setOptions($options)
    {
        $this->options = $options;
    
        return $this;
    }

    /**
     * Get options
     *
     * @return string 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Populate the attributes of UniversalQuestion with available attributes of QuestinoImpl entity
     *
     * @param QuestionImpl $question
     * @return UniversalQuestion
     */
    public function populateQuestion(QuestionImpl $question)
    {
        $this->id = $question->getId();
        $this->type = $question->getQuestionType();
        $this->question = $question->getQuestion();

        return $this;
    }

    /**
     * Concatenate and populate the options text and save them to options attribute
     *
     * @param array of OptionImpl $options
     * @return UniversalQuestion
     */
    public function populateOptions(array $options)
    {
        $this->options = "";
        foreach ($options as $option) {
            $this->options = $this->options . $option->getOption() . PHP_EOL;
        }
        $this->options = rtrim($this->options);
        return $this;
    }
}