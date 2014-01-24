<?php

namespace Poll\PollBundle\Query;


class PollQuery {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }

    public function getQuestionsByPollId($poll_id) {
        $query = $this->em->createQueryBuilder()
            ->select('q')
            ->from('PollPollBundle:QuestionImpl', 'q')
            ->where('q.poll_id = ?1')
            ->setParameter(1, $poll_id)
            ->getQuery();

        return $query->getResult();
    }

    public function getOptionsArrayByQuestionId($question_id) {
        $query = $this->em->createQueryBuilder()
            ->select('o')
            ->from('PollPollBundle:Choice\OptionImpl', 'o')
            ->where('o.question = ?1')
            ->setParameter(1, $question_id)
            ->getQuery();
        return $query->getArrayResult();
    }

    public function getOptionsByQuestionId($question_id) {
        $query = $this->em->createQueryBuilder()
            ->select('o')
            ->from('PollPollBundle:Choice\OptionImpl', 'o')
            ->where('o.question = ?1')
            ->setParameter(1, $question_id)
            ->getQuery();
        return $query->getResult();
    }

} 