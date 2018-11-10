<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 04/11/2018
 * Time: 13:27
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Position
 *
 * @ORM\Table(name="position")
 * @ORM\Entity(repositoryClass="App\Repository\PositionRepository")
 */
class Position
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    private $id;
    /**
     * @var int
     *
     * @ORM\Column(name="place", type="integer")
     */
    private $place;


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
     * Set place
     *
     * @param integer $place
     *
     * @return Position
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }
    /**
     * Get place
     *
     * @return int
     */
    public function getPlace(): int
    {
        return $this->place;
    }

}