<?php

namespace App\Services;

use App\Entity\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;
use App\Services\mailer;

class EmailService
{
   /**
    public function __construct(EngineInterface $engine, mailer $mailer)
    {
        $this->ei = $engine;
        $this->mailer = $mailer;
        $this->subject = 'Annuaire BienEtre Création de Service';
    }

    public function sendMailConfirm(Utilisateur $utilisateur)
    {

        $to = $utilisateur->getEmail();
        $body = $this->ei->render('record/msg_newService.html.twig', array('user'=> $to));

        $this->mailer->sendMessage($to, $this->subject, $body);

    }
*/
}