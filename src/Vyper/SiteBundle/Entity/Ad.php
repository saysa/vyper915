<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vyper\SiteBundle\Components\Strings\StringMethods;

/**
 * Ad
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\AdRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Ad
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
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\LocaleType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $locale;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\AdType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="bgcolor", type="string", length=10, nullable=true)
     */
    private $bgcolor;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pictureFr;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pictureEn;

    /**
     * @var integer
     * Pour stocker l'ID du formulaire
     */
    private $pictureFrID;

    /**
     * @var integer
     * Pour stocker l'ID du formulaire
     */
    private $pictureEnID;

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
     * Set link
     *
     * @param string $link
     * @return Ad
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set bgcolor
     *
     * @param string $bgcolor
     * @return Ad
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;

        return $this;
    }

    /**
     * Get bgcolor
     *
     * @return string
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Set type
     *
     * @param \Vyper\SiteBundle\Entity\AdType $type
     * @return Ad
     */
    public function setType(\Vyper\SiteBundle\Entity\AdType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Vyper\SiteBundle\Entity\AdType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set live
     *
     * @param boolean $live
     * @return Ad
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
     * @return Ad
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
     * @return Ad
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
     * @return Ad
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
     * Set pictureFr
     *
     * @param \Vyper\SiteBundle\Entity\Picture $pictureFr
     * @return Ad
     */
    public function setPictureFr(\Vyper\SiteBundle\Entity\Picture $pictureFr = null)
    {
        $this->pictureFr = $pictureFr;

        return $this;
    }

    /**
     * Get pictureFr
     *
     * @return \Vyper\SiteBundle\Entity\Picture
     */
    public function getPictureFr()
    {
        return $this->pictureFr;
    }

    /**
     * Set pictureEn
     *
     * @param \Vyper\SiteBundle\Entity\Picture $pictureEn
     * @return Ad
     */
    public function setPictureEn(\Vyper\SiteBundle\Entity\Picture $pictureEn = null)
    {
        $this->pictureEn = $pictureEn;

        return $this;
    }

    /**
     * Get pictureEn
     *
     * @return \Vyper\SiteBundle\Entity\Picture
     */
    public function getPictureEn()
    {
        return $this->pictureEn;
    }

    /**
     * @param int $pictureFrID
     */
    public function setPictureFrID($pictureFrID)
    {
        $this->pictureFrID = $pictureFrID;
    }

    /**
     * @return int
     */
    public function getPictureFrID()
    {
        return $this->pictureFrID;
    }

    /**
     * @param int $pictureEnID
     */
    public function setPictureEnID($pictureEnID)
    {
        $this->pictureEnID = $pictureEnID;
    }

    /**
     * @return int
     */
    public function getPictureEnID()
    {
        return $this->pictureEnID;
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
     * Set locale
     *
     * @param \Vyper\SiteBundle\Entity\LocaleType $locale
     * @return Article
     */
    public function setLocale(\Vyper\SiteBundle\Entity\LocaleType $locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return \Vyper\SiteBundle\Entity\LocaleType
     */
    public function getLocale()
    {
        return $this->locale;
    }


}
