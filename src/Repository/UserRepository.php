<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 05/11/2018
 * Time: 14:38
 */

namespace App\Repository;


class UserRepository extends \Doctrine\ORM\EntityRepository
{

    public function newsletterUser(){

        $qb = $this->createQueryBuilder('d');
        $qb->where('d.newsletter = true');
        $qb->andWhere('d.banned = false');
        $qb->andWhere('d.confirmed = true');

        return $qb
            ->getQuery()
            ->getResult();
    }

}