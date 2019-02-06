<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 05/11/2018
 * Time: 20:46
 */

namespace App\Services;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;



class Persist
{

    protected $manager;
    protected $session;

    public function __construct(ObjectManager $entityManager, SessionInterface $session)
    {
        $this->manager = $entityManager;
        $this->session = $session;
    }

    public function persist($element)
    {
        try {
            $this->manager->persist($element);
            $this->manager->flush();

            return true;

        } catch (\Exception $e) {
            dd($e->getMessage());

            return false;

        }
    }

    public function remove($element)
    {
        try {
            $this->manager->remove($element);
            $this->manager->flush();

            return true;

        } catch (\Exception $e) {


            return false;

        }
    }

    public function flush()
    {
        try {
            $this->manager->flush();

            return true;

        } catch (\Exception $e) {


            return false;

        }
    }

}