<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;

/**
 * ChangePassword
 * @ORM\Entity(repositoryClass="App\Repository\ChangePasswordRepository")
 */
class ChangePassword {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO") 
     */
    private $id;

    /**
     * @ORM\Column(name="password", type="string", length=150)
     * 
     * @SecurityAssert\UserPassword(
     *     message = "Password error"
     * )
     */
    private $password;

    /**
     * @ORM\Column(name="newPassword", type="string", length=150)
     * @Assert\NotBlank(message="Choose a password")
     */
    private $newPassword;

    /**
     * @Assert\NotBlank(message="Confirm your password")
     */
    private $confNewPassword;

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
        return $this;
    }

    public function getNewPassword() {
        return $this->newPassword;
    }

    public function setConfNewPassword($confNewPassword) {
        $this->confNewPassword = $confNewPassword;
        return $this;
    }

    public function getConfNewPassword() {
        return $this->confNewPassword;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }

    public function getId() {
        return $this->id;
    }

}
