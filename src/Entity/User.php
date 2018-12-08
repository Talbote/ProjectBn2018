<?php

namespace App\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="userType", type="string")
 * @ORM\DiscriminatorMap({"users" = "User", "members" = "Member", "providers" = "Provider"})
 * @UniqueEntity(fields={"eMail"}, message="Vous avez déjà un compte avec cette adresse")
 *
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * * @Assert\Valid
     *
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\Email(
     *     message = "this email '{{ value }}'  is not valid.",
     *     checkMX = true
     * )
     * @ORM\Column(name="e_mail", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank(message="Email required.")
     *
     */
    private $eMail;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="password", type="string", length=255)
     *
     *
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "message required 3 minimun."
     * )
     *
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="addresse_no", type="string", length=5, nullable=true)
     */
    private $addressNo;

    /**
     * @var string
     *
     * @ORM\Column(name="street_name", type="string", length=255, nullable=true)
     */
    private $streetName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="registration_date", type="datetime", nullable=true)
     */
    private $registrationDate;


    /**
     * @var int
     *
     * @ORM\Column(name="test_no", type="integer", nullable=true)
     */
    private $testNo;

    /**
     * @var bool
     *
     * @ORM\Column(name="banned", type="boolean", nullable=true)
     */
    private $banned;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirmed", type="boolean", nullable=true)
     */
    private $confirmed;

    /**
     * @var bool
     *
     * @ORM\Column(name="newsletter", type="boolean")
     *
     */
    private $newsletter;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PostalCode")
     *
     * @ORM\JoinColumn(name="postal_code", nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Locality")
     *
     * @ORM\JoinColumn(name="locality", nullable=true)
     */
    private $locality;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\City")
     *
     * @ORM\JoinColumn(name="city", nullable=true, onDelete="SET NULL")
     *
     */
    private $city;

    /**
     * @ORM\Column(type="json_array"))
     */
    private $roles=[];






// security

    public function getUsername()
    {
        return $this->eMail;
    }

    public function getRoles()
    {
        $roles = $this->roles;

        if(!in_array('ROLE_USER', $roles)){
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
//end security

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set eMail
     *
     * @param string $eMail
     *
     * @return User
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;

        return $this;
    }

    /**
     * Get eMail
     *
     * @return string
     */
    public function getEMail()
    {
        return $this->eMail;
    }



    /**
     * Set addressNo
     *
     * @param string $addressNo
     *
     * @return User
     */
    public function setAddressNo($addressNo)
    {
        $this->addressNo = $addressNo;

        return $this;
    }

    /**
     * Get addressNo
     *
     * @return string
     */
    public function getAddressNo()
    {
        return $this->addressNo;
    }

    /**
     * Set streetName
     *
     * @param string $streetName
     *
     * @return User
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set registrationDate
     *
     * @param \DateTime $registrationDate
     *
     * @return User
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     * Get registrationDate
     *
     * @return \DateTime
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }


    /**
     * Set testNo
     *
     * @param integer $testNo
     *
     * @return User
     */
    public function setTestNo($testNo)
    {
        $this->testNo = $testNo;

        return $this;
    }

    /**
     * Get testNo
     *
     * @return int
     */
    public function getTestNo()
    {
        return $this->testNo;
    }

    /**
     * Set banned
     *
     * @param boolean $banned
     *
     * @return User
     */
    public function setBanned($banned)
    {
        $this->banned = $banned;

        return $this;
    }

    /**
     * Get banned
     *
     * @return bool
     */
    public function getBanned()
    {
        return $this->banned;
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     *
     * @return User
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return bool
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }


    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }


    /**
     * @return string
     */
    public function getLocality()
    {
        return $this->locality;
    }

    /**
     * @param string $locality
     */
    public function setLocality($locality)
    {
        $this->locality = $locality;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     *
     * @return User
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return bool
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }


}

