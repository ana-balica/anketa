<?php

namespace Poll\PollBundle\Query;


class PollQuery {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
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

    public function getAnswerCountryByOptionId($option_id) {
        $query = $this->em->createQueryBuilder()
            ->select('count(a.id)')
            ->from('PollPollBundle:AnswerImpl', 'a')
            ->leftJoin('a.options', 'o')
            ->where('o.id = ?1')
            ->setParameter(1, $option_id)
            ->getQuery();
        return $query->getSingleScalarResult();
    }
} 