<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PollRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy([], ['createDate' => 'DESC']);
    }

}