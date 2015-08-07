<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picture
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\PictureRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Picture
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="photoCredit", type="string", length=255, nullable=true)
     */
    private $photoCredit;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=32)
     */
    private $mime;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer")
     */
    private $size;

    /**
     * @var integer
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var integer
     *
     * @ORM\Column(name="height", type="integer")
     */
    private $height;

    /**
     * @ORM\ManyToOne(targetEntity="Vyper\SiteBundle\Entity\Album")
     * @ORM\JoinColumn(nullable=false)
     */
    private $album;

    /**
     * Attribute using in the form
     */
    private $file;

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
     * Set filename
     *
     * @param string $filename
     * @return Picture
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Picture
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
     * Set mime
     *
     * @param string $mime
     * @return Picture
     */
    public function setMime($mime)
    {
        $this->mime = $mime;

        return $this;
    }

    /**
     * Get mime
     *
     * @return string 
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set size
     *
     * @param integer $size
     * @return Picture
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set width
     *
     * @param integer $width
     * @return Picture
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return Picture
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set live
     *
     * @param boolean $live
     * @return Picture
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
     * @return Picture
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
     * @return Picture
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
     * @return Picture
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
     * Set album
     *
     * @param \Vyper\SiteBundle\Entity\Album $album
     * @return Picture
     */
    public function setAlbum(\Vyper\SiteBundle\Entity\Album $album)
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
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        $year = date("Y", time());
        $month = date("m", time());
        $time = time();
        $rd = rand(0, 9999);
        $extension = $this->file->guessExtension();
        if (!$extension) {
            $extension = 'bin';
        }
        $filename = "{$rd}-{$time}.{$extension}";
        $this->file->move($this->getUploadRootDir() . "/{$year}/{$month}", $filename);

        $meta = getimagesize("{$this->getUploadRootDir()}" . "/{$year}/{$month}/{$filename}");
        if ($meta) {

            $width = $meta[0];
            $height = $meta[1];

            $this->setFilename($filename);
            $this->setWidth($width);
            $this->setHeight($height);
            $this->setSize($this->file->getClientSize());
            $this->setMime($this->file->getClientMimeType());
        }

    }

    /**
     * Returns "{$year}/{$month}" string
     * @param null $pip_cat
     * @return string
     */
    public function getPath($pip_cat = null)
    {
        $year  = substr($this->getCreated()->format('Y-m-d H:i:s'), 0, 4);
        $month = substr($this->getCreated()->format('Y-m-d H:i:s'), 5, 2);

        if (!is_null($pip_cat)) {
            $pip = "?size=" . $pip_cat;
        } else {
            $pip = null;
        }

        return $this->getUploadDir() . "/{$year}/{$month}/" . $this->getFilename() . $pip;
    }

    /**
     * @return string
     * Returns the relative path from a web browser
     */
    public function getUploadDir()
    {
        return 'uploads/pic';
    }

    /**
     * @return string
     * Returns relative path from PHP code
     */
    protected function getUploadRootDir()
    {
        return APP_PATH . '/web/' . $this->getUploadDir();
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
     * Set photoCredit
     *
     * @param string $photoCredit
     * @return Picture
     */
    public function setPhotoCredit($photoCredit)
    {
        $this->photoCredit = $photoCredit;

        return $this;
    }

    /**
     * Get photoCredit
     *
     * @return string 
     */
    public function getPhotoCredit()
    {
        return $this->photoCredit;
    }
}
