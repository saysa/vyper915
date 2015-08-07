<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\VoteRepository")
 */
class Vote
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
     * @ORM\Column(name="ip", type="string", length=255)
     */
    private $ip;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Picture")
     * @ORM\JoinColumn(nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Song")
     * @ORM\JoinColumn(nullable=true)
     */
    private $song;

    /**
     * @var string
     *
     * @ORM\Column(name="mark", type="string", length=5)
     */
    private $mark;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="moment", type="datetime")
     */
    private $moment;


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
     * Set ip
     *
     * @param string $ip
     * @return Vote
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set mark
     *
     * @param string $mark
     * @return Vote
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return string 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set picture
     *
     * @param \Vyper\SiteBundle\Entity\Picture $picture
     * @return Vote
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
     * Set song
     *
     * @param \Vyper\SiteBundle\Entity\Song $song
     * @return Vote
     */
    public function setSong(\Vyper\SiteBundle\Entity\Song $song = null)
    {
        $this->song = $song;

        return $this;
    }

    /**
     * Get song
     *
     * @return \Vyper\SiteBundle\Entity\Song 
     */
    public function getSong()
    {
        return $this->song;
    }

    /**
     * Set moment
     *
     * @param \DateTime $moment
     * @return Vote
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return \DateTime 
     */
    public function getMoment()
    {
        return $this->moment;
    }
}
