<?php
/**
 * Created by PhpStorm.
 * User: Fab
 * Date: 8/04/18
 * Time: 13:37
 */

namespace App\Services;



class Mailer
{


    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMessage($mail, $subject, $body)
    {

        $message =(new \Swift_Message($subject))
            ->setFrom("administration@bien-être.com")
            ->setTo($mail)
            ->setBody($body)
            ->setContentType("text/html")
        ;

        return $this->mailer->send($message);

    }


}