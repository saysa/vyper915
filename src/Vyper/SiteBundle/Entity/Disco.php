<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Disco
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\DiscoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Disco
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="titleReal", type="string", length=255, nullable=true)
     */
    private $titleReal;

    /**
     * @var string
     *
     * @ORM\Column(name="cdJapan", type="string", length=255, nullable=true)
     */
    private $cdJapan;

    /**
     * @var string
     *
     * @ORM\Column(name="itunes", type="string", length=255, nullable=true)
     */
    private $itunes;

    /**
     * @var string
     *
     * @ORM\Column(name="amazon", type="string", length=255, nullable=true)
     */
    private $amazon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="labelMusic", type="string", length=255, nullable=true)
     */
    private $labelMusic;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="text", nullable=true)
     */
    private $details;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Medium")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medium;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\DiscoType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Country")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Continent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $continent;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Picture", cascade={"persist"})
     */
    private $picture;

    /**
     * @var integer
     * Pour stocker l'ID du formulaire
     */
    private $pictureID;

    /**
     * @ORM\ManyToMany(targetEntity="Vyper\SiteBundle\Entity\Artist", cascade={"persist"})
     */
    private $artists;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="live", type="boolean")
     */
    private $live;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Disco
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleReal
     *
     * @param string $titleReal
     * @return Disco
     */
    public function setTitleReal($titleReal)
    {
        $this->titleReal = $titleReal;

        return $this;
    }

    /**
     * Get titleReal
     *
     * @return string 
     */
    public function getTitleReal()
    {
        return $this->titleReal;
    }

    /**
     * Set cdJapan
     *
     * @param string $cdJapan
     * @return Disco
     */
    public function setCdJapan($cdJapan)
    {
        $this->cdJapan = $cdJapan;

        return $this;
    }

    /**
     * Get cdJapan
     *
     * @return string 
     */
    public function getCdJapan()
    {
        return $this->cdJapan;
    }

    /**
     * Set itunes
     *
     * @param string $itunes
     * @return Disco
     */
    public function setItunes($itunes)
    {
        $this->itunes = $itunes;

        return $this;
    }

    /**
     * Get itunes
     *
     * @return string 
     */
    public function getItunes()
    {
        return $this->itunes;
    }

    /**
     * Set amazon
     *
     * @param string $amazon
     * @return Disco
     */
    public function setAmazon($amazon)
    {
        $this->amazon = $amazon;

        return $this;
    }

    /**
     * Get amazon
     *
     * @return string 
     */
    public function getAmazon()
    {
        return $this->amazon;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Disco
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set labelMusic
     *
     * @param string $labelMusic
     * @return Disco
     */
    public function setLabelMusic($labelMusic)
    {
        $this->labelMusic = $labelMusic;

        return $this;
    }

    /**
     * Get labelMusic
     *
     * @return string 
     */
    public function getLabelMusic()
    {
        return $this->labelMusic;
    }

    /**
     * Set details
     *
     * @param string $details
     * @return Disco
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set live
     *
     * @param boolean $live
     * @return Disco
     */
    public function setLive($live)
    {
        $this->live = $live;

        return $this;
    }

    /**
     * Get live
     *
     * @return boolean 
     */
    public function getLive()
    {
        return $this->live;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Disco
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Disco
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Disco
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set medium
     *
     * @param \Vyper\SiteBundle\Entity\Medium $medium
     * @return Disco
     */
    public function setMedium(\Vyper\SiteBundle\Entity\Medium $medium)
    {
        $this->medium = $medium;

        return $this;
    }

    /**
     * Get medium
     *
     * @return \Vyper\SiteBundle\Entity\Medium 
     */
    public function getMedium()
    {
        return $this->medium;
    }

    /**
     * Set type
     *
     * @param \Vyper\SiteBundle\Entity\DiscoType $type
     * @return Disco
     */
    public function setType(\Vyper\SiteBundle\Entity\DiscoType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Vyper\SiteBundle\Entity\DiscoType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set country
     *
     * @param \Vyper\SiteBundle\Entity\Country $country
     * @return Disco
     */
    public function setCountry(\Vyper\SiteBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Vyper\SiteBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set continent
     *
     * @param \Vyper\SiteBundle\Entity\Continent $continent
     * @return Disco
     */
    public function setContinent(\Vyper\SiteBundle\Entity\Continent $continent)
    {
        $this->continent = $continent;

        return $this;
    }

    /**
     * Get continent
     *
     * @return \Vyper\SiteBundle\Entity\Continent 
     */
    public function getContinent()
    {
        return $this->continent;
    }

    /**
     * Set picture
     *
     * @param \Vyper\SiteBundle\Entity\Picture $picture
     * @return Disco
     */
    public function setPicture(\Vyper\SiteBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \Vyper\SiteBundle\Entity\Picture 
     */
    public function getPicture()
    {
        return $this->picture;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->artists = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add artists
     *
     * @param \Vyper\SiteBundle\Entity\Artist $artist
     * @return Disco
     */
    public function addArtist(\Vyper\SiteBundle\Entity\Artist $artist)
    {
        $this->artists[] = $artist;

        return $this;
    }

    /**
     * Remove artists
     *
     * @param \Vyper\SiteBundle\Entity\Artist $artist
     */
    public function removeArtist(\Vyper\SiteBundle\Entity\Artist $artist)
    {
        $this->artists->removeElement($artist);
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * @param int $pictureID
     */
    public function setPictureID($pictureID)
    {
        $this->pictureID = $pictureID;
    }

    /**
     * @return int
     */
    public function getPictureID()
    {
        return $this->pictureID;
    }

    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setLive(true);
        $this->setDeleted(false);
        $this->setCreated(new \DateTime('now'));
        $this->setmodified(new \DateTime('now'));
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setmodified(new \DateTime('now'));
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Artist
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
