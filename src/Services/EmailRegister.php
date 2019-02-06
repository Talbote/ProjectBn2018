<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 05/11/2018
 * Time: 19:40
 */

namespace App\Services;

use App\Entity\PreRegister;
use Doctrine\ORM\EntityManager;

use Symfony\Component\Templating\EngineInterface;


class EmailRegister
{


    public function __construct(EngineInterface $engine, Mailer $mailer)
    {
        $this->ei = $engine;
        $this->mailer = $mailer;
        $this->subject = 'Annuaire BienEtre Inscription';
    }

    public function sendEmailConfirm(PreRegister $new_user)
    {

        $to = $new_user->getEmail();
        $body = $this->ei->render('records/message/message_register.html.twig', array('new_user'=> $new_user));

        $this->mailer->sendMessage($to, $this->subject, $body);

    }

}