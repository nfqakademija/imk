<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PollRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy([], ['createDate' => 'DESC']);
    }

    public function searchByCategoryOrPollName($str){
        return $this->createQueryBuilder('p')
            ->innerJoin('p.categories', 'c')
            ->where('c.title LIKE :str OR p.title LIKE :str')
            ->setParameter('str', $str.'%')
            ->getQuery()->getResult();
    }

    public function searchByTitle($str){
        return $this->createQueryBuilder('p')
            ->select('p.title')
            ->where('p.title LIKE :str')
            ->setParameter('str', $str.'%')
            ->distinct()
            ->getQuery()->getResult();
    }

}