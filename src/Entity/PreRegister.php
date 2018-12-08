<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 04/11/2018
 * Time: 14:30
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @UniqueEntity(fields={"email"}, message="You have already sent a registration request pending validation with this email address")
 *
 * PreInscription
 *
 * @ORM\Table(name="pre_register")
 * @ORM\Entity(repositoryClass="App\Repository\PreRegisterRepository")
 */

class PreRegister
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\Email(
     *     message = "L'email '{{ value }}' est invalde.",
     *     checkMX = true
     * )
     * @Assert\NotBlank(message="Une adresse email est requise")
     * @ORM\Column(name="email", type="string", length=80, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=255, unique=true,nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="userType", type="string", length=255)
     */
    private $userType;

    /**
     * @Assert\NotBlank(message="un mot de passe est requise")
     *
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $pwd;

    /**
     * @var datetime
     *
     * @ORM\Column(name="firstRegistrationDate", type="datetime")
     */
    private $firstRegisterDate;


    public function __construct()
    {
        $this->firstRegisterDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Set token
     *
     * @param string $token
     *
     * @return SignUp
     */
    public function setToken()
    {
        $this->token = sha1(uniqid(mt_rand(), true));

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * @param string $userType
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;
    }

    /**
     * @return datetime
     */
    public function getFirstRegisterDate()
    {
        return $this->firstRegisterDate;
    }

    /**
     * @param datetime $firstRegisterDate
     */
    public function setFirstRegisterDate($firstRegisterDate)
    {
        $this->firstRegisterDate = $firstRegisterDate;
    }

    /**
     * @return string
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * @param string $pwd
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;
    }


}