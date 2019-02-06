<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 05/11/2018
 * Time: 19:27
 */

namespace App\Repository;


class PreRegisterRepository extends \Doctrine\ORM\EntityRepository
{

    public function findOneByToken($token){

        $qb = $this->createQueryBuilder('preRegister');

        $qb
            ->where('preRegister.token = :token')
            ->setParameter('token',$token)
        ;

        return $qb
            ->getQuery()
            ->getSingleResult();

    }
}