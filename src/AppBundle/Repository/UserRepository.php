<?php

namespace AppBundle\Repository;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function loadUserByUsername($userName)
    {
        return $this->createQueryBuilder('u')
            ->where('u.userName = :userName OR u.email = :email')
            ->setParameter('userName', $userName)
            ->setParameter('email', $userName)
            ->getQuery()
            ->getOneOrNullResult();
    }
}