<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 04/11/2018
 * Time: 13:26
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
Use Symfony\Component\Validator\Constraints as Assert;

/**
 * ResetPassword
 *
 * @ORM\Table(name="reset_password")
 */
class ResetPassword
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
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     * @var string
     *
     * @ORM\Column(name="new_password", type="string", length=255)
     */
    private $newPassword;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set newPassword.
     *
     * @param string $newPassword
     *
     * @return ResetPassword
     */
    public function setNewPassword($newPassword)
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    /**
     * Get newPassword.
     *
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }
}
