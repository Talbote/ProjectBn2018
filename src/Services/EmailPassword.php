<?php
namespace App\Services;

use App\Entity\User;
use App\Entity\Provider;
use App\Entity\Member;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Templating\EngineInterface;
use App\Services\Mailer;

class EmailPassword
{
    public function __construct(EngineInterface $engine, Mailer $mailer)
    {
        $this->ei = $engine;
        $this->mailer = $mailer;
        $this->subject = 'Annuaire Bien être - new password';
    }

    public function sendMailConfirm(User $u)
    {

        $to = $u->getEMail();
        $body = $this->ei->render('records/message/message_password.html.twig', array('u'=> $to));

        $this->mailer->sendMessage($to, $this->subject, $body);

    }

}