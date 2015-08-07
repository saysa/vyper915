<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Vyper\SiteBundle\Components\Strings\StringMethods;

/**
 * Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\ArticleRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Article
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
     * @ORM\ManyToOne(targetEntity="Vyper\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var boolean
     *
     * @ORM\Column(name="highlight", type="boolean")
     */
    private $highlight;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Continent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $continent;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="textEN", type="text", nullable=true)
     */
    private $textEN;

    /**
     * @var string
     *
     * @ORM\Column(name="textJP", type="text", nullable=true)
     */
    private $textJP;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseDate", type="date")
     */
    private $releaseDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releaseTime", type="time")
     */
    private $releaseTime;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=50)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="translator", type="string", length=50, nullable=true)
     */
    private $translator;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255, nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="sourceURL", type="string", length=255, nullable=true)
     */
    private $sourceURL;

    /**
     * @var string
     *
     * @ORM\Column(name="metaKeywords", type="text", nullable=true)
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="artistsKeywords", type="text", nullable=true)
     */
    private $artistsKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube", type="string", length=255, nullable=true)
     */
    private $youtube;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\ArticleType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $articleType;

    /**
     * @var string
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Picture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Album")
     * @ORM\JoinColumn(nullable=true)
     */
    private $album;

    /**
     * @ORM\ManyToMany(targetEntity="Vyper\SiteBundle\Entity\Theme", cascade={"persist"})
     */
    private $themes;

    /**
     * @ORM\ManyToMany(targetEntity="Vyper\SiteBundle\Entity\Artist", cascade={"persist"})
     */
    private $artists;

    /**
     * @var integer
     * Pour stocker l'ID du formulaire
     */
    private $pictureID;

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
     * Set highlight
     *
     * @param boolean $highlight
     * @return Article
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;

        return $this;
    }

    /**
     * Get highlight
     *
     * @return boolean 
     */
    public function getHighlight()
    {
        return $this->highlight;
    }


    /**
     * Set title
     *
     * @param string $title
     * @return Article
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
     * Set description
     *
     * @param string $description
     * @return Article
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
     * Set text
     *
     * @param string $text
     * @return Article
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     * @return Article
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime 
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set releaseTime
     *
     * @param \DateTime $releaseTime
     * @return Article
     */
    public function setReleaseTime($releaseTime)
    {
        $this->releaseTime = $releaseTime;

        return $this;
    }

    /**
     * Get releaseTime
     *
     * @return \DateTime 
     */
    public function getReleaseTime()
    {
        return $this->releaseTime;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set translator
     *
     * @param string $translator
     * @return Article
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Get translator
     *
     * @return string 
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Article
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set sourceURL
     *
     * @param string $sourceURL
     * @return Article
     */
    public function setSourceURL($sourceURL)
    {
        $this->sourceURL = $sourceURL;

        return $this;
    }

    /**
     * Get sourceURL
     *
     * @return string 
     */
    public function getSourceURL()
    {
        return $this->sourceURL;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Article
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set artistsKeywords
     *
     * @param string $artistsKeywords
     * @return Article
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
     * Set youtube
     *
     * @param string $youtube
     * @return Article
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;

        return $this;
    }

    /**
     * Get youtube
     *
     * @return string 
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set live
     *
     * @param boolean $live
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * @return Article
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
     * Set slug
     *
     * @param string $slug
     * @return Article
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



    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {

        $this->setDeleted(false);
        $this->setCreated(new \DateTime('now'));
        $this->setmodified(new \DateTime('now'));
    }

    /**
     * Set articleType
     *
     * @param \Vyper\SiteBundle\Entity\ArticleType $articleType
     * @return Article
     */
    public function setArticleType(\Vyper\SiteBundle\Entity\ArticleType $articleType)
    {
        $this->articleType = $articleType;

        return $this;
    }

    /**
     * Get articleType
     *
     * @return \Vyper\SiteBundle\Entity\ArticleType 
     */
    public function getArticleType()
    {
        return $this->articleType;
    }

    /**
     * Set continent
     *
     * @param \Vyper\SiteBundle\Entity\Continent $continent
     * @return Article
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
     * @return Article
     */
    public function setPicture(\Vyper\SiteBundle\Entity\Picture $picture)
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
        $this->themes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add themes
     *
     * @param \Vyper\SiteBundle\Entity\Theme $theme
     * @return Article
     */
    public function addTheme(\Vyper\SiteBundle\Entity\Theme $theme)
    {
        $this->themes[] = $theme;

        return $this;
    }

    /**
     * Remove themes
     *
     * @param \Vyper\SiteBundle\Entity\Theme $theme
     */
    public function removeTheme(\Vyper\SiteBundle\Entity\Theme $theme)
    {
        $this->themes->removeElement($theme);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTheme()
    {
        return $this->themes;
    }

    /**
     * Add artists
     *
     * @param \Vyper\SiteBundle\Entity\Artist $artist
     * @return Article
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
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThemes()
    {
        return $this->themes;
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

    public function getReleaseDateFrontFormat()
    {
        return StringMethods::sqlDateToCustom($this->getReleaseDate()->format('Y-m-d'));
    }


    /**
     * Set user
     *
     * @param \Vyper\UserBundle\Entity\User $user
     * @return Article
     */
    public function setUser(\Vyper\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Vyper\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set album
     *
     * @param \Vyper\SiteBundle\Entity\Album $album
     * @return Article
     */
    public function setAlbum(\Vyper\SiteBundle\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album
     *
     * @return \Vyper\SiteBundle\Entity\Album 
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set textEN
     *
     * @param string $textEN
     * @return Article
     */
    public function setTextEN($textEN)
    {
        $this->textEN = $textEN;

        return $this;
    }

    /**
     * Get textEN
     *
     * @return string 
     */
    public function getTextEN()
    {
        return $this->textEN;
    }

    /**
     * Set textJP
     *
     * @param string $textJP
     * @return Article
     */
    public function setTextJP($textJP)
    {
        $this->textJP = $textJP;

        return $this;
    }

    /**
     * Get textJP
     *
     * @return string 
     */
    public function getTextJP()
    {
        return $this->textJP;
    }
}
