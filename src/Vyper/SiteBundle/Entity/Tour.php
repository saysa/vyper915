<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tour
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\TourRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tour
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
     * @ORM\Column(name="realTitle", type="string", length=255, nullable=true)
     */
    private $realTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionLocal", type="text", nullable=true)
     */
    private $descriptionLocal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="artistsKeywords", type="string", length=255, nullable=true)
     */
    private $artistsKeywords;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\TourType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Continent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $continent;

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
     * @return Tour
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
     * Set realTitle
     *
     * @param string $realTitle
     * @return Tour
     */
    public function setRealTitle($realTitle)
    {
        $this->realTitle = $realTitle;

        return $this;
    }

    /**
     * Get realTitle
     *
     * @return string 
     */
    public function getRealTitle()
    {
        return $this->realTitle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Tour
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
     * Set descriptionLocal
     *
     * @param string $descriptionLocal
     * @return Tour
     */
    public function setDescriptionLocal($descriptionLocal)
    {
        $this->descriptionLocal = $descriptionLocal;

        return $this;
    }

    /**
     * Get descriptionLocal
     *
     * @return string 
     */
    public function getDescriptionLocal()
    {
        return $this->descriptionLocal;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Tour
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Tour
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set artistsKeywords
     *
     * @param string $artistsKeywords
     * @return Tour
     */
    public function setArtistsKeywords($artistsKeywords)
    {
        $this->artistsKeywords = $artistsKeywords;

        return $this;
    }

    /**
     * Get artistsKeywords
     *
     * @return string 
     */
    public function getArtistsKeywords()
    {
        return $this->artistsKeywords;
    }

    /**
     * Set live
     *
     * @param boolean $live
     * @return Tour
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
     * @return Tour
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
     * @return Tour
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
     * @return Tour
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
     * Set type
     *
     * @param \Vyper\SiteBundle\Entity\TourType $type
     * @return Tour
     */
    public function setType(\Vyper\SiteBundle\Entity\TourType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Vyper\SiteBundle\Entity\TourType 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set continent
     *
     * @param \Vyper\SiteBundle\Entity\Continent $continent
     * @return Tour
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
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setLive(true);
        $this->setDeleted(false);
        $this->setCreated(new \DateTime('now'));
        $this->setmodified(new \DateTime('now'));
    }
}
