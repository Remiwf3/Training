<?php

namespace KAL\PlatformBundle\Repository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBestProprio($limit){
        return $this->createQueryBuilder('u')
                    ->join('u.ads', 'a')
                    ->join('a.comments', 'c')
                    ->select('u as user, AVG(c.rating) as avgRatings')
                    ->groupBy('u')
                    ->orderBy('avgRatings', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult()
                ;
    }
}