<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Slider
 *
 * @ORM\Table(name="slider")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\SliderRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Slider
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
     * @ORM\Column(name="titlear", type="string", length=255)
     */
    private $titlear;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shortDetail", type="string", length=255)
     */
    private $shortDetail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shortDetailar", type="string", length=255)
     */
    private $shortDetailar;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;
	
    private $temp;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    	$this->updatedAt = new \DateTime();
    }

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
     * @return Slider
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Slider
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Slider
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    
    /********/
    
    
    public function getAbsolutePath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getWebPath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadDir().'/'.$this->path;
    }
    
    protected function getUploadRootDir()
    {
    	// the absolute directory path where uploaded
    	// documents should be saved
    	return __DIR__.'/../../../../public_html/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/slider';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
    	$this->file = $file;
    	// check if we have an old image path
    	if (isset($this->path)) {
    		// store the old name to delete after the update
    		$this->temp = $this->path;
    		$this->path = null;
    	} else {
    		$this->path = 'initial';
    	}
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
    	return $this->file;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
    	if (null !== $this->getFile()) {
    		// do whatever you want to generate a unique name
    		$filename = sha1(uniqid(mt_rand(), true));
    		$this->path = $filename.'.'.$this->getFile()->guessExtension();
    	}
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
    	if (null === $this->getFile()) {
    		return;
    	}
    
    	// if there is an error when moving the file, an exception will
    	// be automatically thrown by move(). This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFile()->move($this->getUploadRootDir(), $this->path);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$this->file = null;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
    	if ($file = $this->getAbsolutePath()) {
    		unlink($file);
    	}
    }
    
    /**
     * Set path
     *
     * @param string $path
     * @return Photo
     */
    public function setPath($path)
    {
    	$this->path = $path;
    
    	return $this;
    }
    
    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
    	return $this->path;
    }

    /**
     * Set titlear
     *
     * @param string $titlear
     * @return Slider
     */
    public function setTitlear($titlear)
    {
        $this->titlear = $titlear;

        return $this;
    }

    /**
     * Get titlear
     *
     * @return string 
     */
    public function getTitlear()
    {
        return $this->titlear;
    }

    /**
     * Set shortDetail
     *
     * @param string $shortDetail
     * @return Slider
     */
    public function setShortDetail($shortDetail)
    {
        $this->shortDetail = $shortDetail;

        return $this;
    }

    /**
     * Get shortDetail
     *
     * @return string 
     */
    public function getShortDetail()
    {
        return $this->shortDetail;
    }

    /**
     * Set shortDetailar
     *
     * @param string $shortDetailar
     * @return Slider
     */
    public function setShortDetailar($shortDetailar)
    {
        $this->shortDetailar = $shortDetailar;

        return $this;
    }

    /**
     * Get shortDetailar
     *
     * @return string 
     */
    public function getShortDetailar()
    {
        return $this->shortDetailar;
    }
}
