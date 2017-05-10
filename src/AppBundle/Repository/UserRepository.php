<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
      * @param string $userName
      * @return User
      */
    public function findByUsernameOrEmail($userName)
    {
        return $this->createQueryBuilder('u')
            ->where('u.userName = :userName OR u.email = :userName')
            ->setParameter('userName', $userName)
            ->getQuery()
            ->getOneOrNullResult();
    }
}