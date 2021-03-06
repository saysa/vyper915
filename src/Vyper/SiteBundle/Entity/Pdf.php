<?php

namespace Vyper\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pdf
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vyper\SiteBundle\Entity\PdfRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Pdf
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
     * @return Pdf
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
     * @return Pdf
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
     * @return Pdf
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
     * @return Pdf
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
     * Set live
     *
     * @param boolean $live
     * @return Pdf
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
     * @return Pdf
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
     * @return Pdf
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
     * @return Pdf
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

        $this->setFilename($filename);
        $this->setSize($this->file->getClientSize());
        $this->setMime($this->file->getClientMimeType());

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
        return 'uploads/pdf';
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

}
