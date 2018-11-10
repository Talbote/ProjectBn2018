<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity(repositoryClass="App\Repository\NewsletterRepository")
 */
class Newsletter
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
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=255, nullable=true)
     */
    private $newsletter;
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\NotBlank(message="Un titre est requis")
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "Un titre du commentaire doit contenir 5 caractères minimun",
     *      maxMessage = "Un titre est trop long, 50 caractères maximun"
     * )
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publication", type="datetime")
     *
     */
    private $publication;

    /**
     * @var string
     *
     * @ORM\Column(name="document_pdf", type="string", length=255, nullable=true)
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Fichier non valide"
     * )
     */
    private $documentPDF;

    /**
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Fichier non valide"
     * )
     */
    protected $file;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    public function __construct()
    {
        $this->publication = new \DateTime('now');

    }


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
     * Set title
     *
     * @param string $title
     *
     * @return Newsletter
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set publication
     *
     * @param \DateTime $publication
     *
     * @return Newsletter
     */
    public function setPublication($publication)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \DateTime
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set documentPDF
     *
     * @param string $documentPDF
     *
     * @return Newsletter
     */
    public function setDocumentPDF($documentPDF)
    {
        $this->documentPDF = $documentPDF;

        return $this;
    }

    /**
     * Get documentPDF
     *
     * @return string
     */
    public function getDocumentPDF()
    {
        return $this->documentPDF;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
