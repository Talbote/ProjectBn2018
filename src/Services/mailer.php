<?php
namespace App\Services;

use Swift_Mailer;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class mailer
{

    /**
    protected $mailer;
    private $from = "talbot-e@hotmail.com";
    private $reply = "";
    private $name = "Annuaire Bienetre";
    private $type= 'text/html';

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMessage($to, $subject, $body)
    {
        $validator = new EmailValidator();
        $validator->isValid($to, new RFCValidation()); //true

        $mail= (new \Swift_Message($subject))
            ->setFrom($this->from,$this->name)
            ->setTo($to)
            ->setBody($body, $this->type)
            ->setReplyTo($this->reply,$this->name);

        $this->mailer->send($mail);

    }
**/

}