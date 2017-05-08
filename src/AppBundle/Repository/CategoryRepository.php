<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    public function searchByTitle($str)
    {
        return $this->getEntityManager()->createQuery(
            'select c from AppBundle:Category c WHERE c.title LIKE :str'
        )
            ->setParameter('str', '%' . $str . '%')
            ->getResult();
    }
}