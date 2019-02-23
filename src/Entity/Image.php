<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
     * @Assert\Image(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Le fichier choisi ne correspond pas à un fichier valide",
     *     notFoundMessage = "file not found",
     *     uploadErrorMessage = "Error upload file"
     * )
     */
    protected $file;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, unique=true)
     *
     */
    private $image;


    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="gallery", cascade={"persist"})
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     */
    private $providerImage;



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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function __toString()
    {
        return $this->image;
    }



    /**
     * @return mixed
     */
    public function getProviderImage()
    {
        return $this->providerImage;
    }

    /**
     * @param mixed $providerImage
     */
    public function setProviderImage($providerImage)
    {
        $this->providerImage = $providerImage;
    }




}

