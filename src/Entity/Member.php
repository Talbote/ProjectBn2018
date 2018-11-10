<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Member
 *
 * @ORM\Table(name="Members")
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist"})
     *
     * @ORM\JoinColumn(name="avatar", onDelete = "SET NULL")
     */
    private $avatar;


    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Abuse", mappedBy="member")
     *
     */
    private $abuses;




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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return string
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return string
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }


    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getAbuses()
    {
        return $this->abuses;
    }

    /**
     * @param mixed $abuses
     */
    public function setAbuses($abuses)
    {
        $this->abuses = $abuses;
    }


}

