<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * Stage
 *
 * @ORM\Table(name="stages")
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=255)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="more_info", type="string", length=255)
     */
    private $moreInfo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="datetime")
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="datetime")
     */
    private $toDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="display_from", type="datetime")
     */
    private $displayFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="display_to", type="datetime")
     */
    private $displayTo;

    /**
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Provider", inversedBy="stages")
     *
     * @ORM\JoinColumn(name="provider")
     */
    private $provider;


    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\column(length=128, nullable=true)
     */
    private $slug;


    public function getProvider()
    {
        return $this->provider;
    }


    public function setProvider($provider)
    {
        $this->provider = $provider;
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
     * Set name
     *
     * @param string $name
     *
     * @return Stage
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Stage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Stage
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set moreInfo
     *
     * @param string $moreInfo
     *
     * @return Stage
     */
    public function setMoreInfo($moreInfo)
    {
        $this->moreInfo = $moreInfo;

        return $this;
    }

    /**
     * Get moreInfo
     *
     * @return string
     */
    public function getMoreInfo()
    {
        return $this->moreInfo;
    }

    /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     *
     * @return Stage
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     *
     * @return Stage
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set displayFrom
     *
     * @param \DateTime $displayFrom
     *
     * @return Stage
     */
    public function setDisplayFrom($displayFrom)
    {
        $this->displayFrom = $displayFrom;

        return $this;
    }

    /**
     * Get displayFrom
     *
     * @return \DateTime
     */
    public function getDisplayFrom()
    {
        return $this->displayFrom;
    }

    /**
     * Set displayTo
     *
     * @param string $displayTo
     *
     * @return Stage
     */
    public function setDisplayTo($displayTo)
    {
        $this->displayTo = $displayTo;

        return $this;
    }

    /**
     * Get displayTo
     *
     * @return \DateTime
     */
    public function getDisplayTo()
    {
        return $this->displayTo;
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

