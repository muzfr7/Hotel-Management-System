<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\AlbumRepository")
 */
class Album
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
     * @Assert\NotBlank()
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="titlear", type="string", length=255)
     */
    private $titlear;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

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
    
    /**
     * @ORM\OneToMany(targetEntity="Albumphoto", mappedBy="album")
     */
    protected $albumphotos;
	
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    	$this->updatedAt = new \DateTime();
    	 
    	$this->albumphotos = new ArrayCollection();
    }
    
    /**
     * Album ID
     *
     * @return string
     */
    public function __toString()
    {
    	return strval($this->title);
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
     * @return Album
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Album
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Album
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
     * @return Album
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
    
    /**
     * Add albumphotos
     *
     * @param \Renz\ModelBundle\Entity\Albumphoto $albumphotos
     * @return Album
     */
    public function addAlbumphoto(Albumphoto $albumphotos)
    {
    	$this->albumphotos[] = $albumphotos;
    
    	return $this;
    }
    
    /**
     * Remove albumphotos
     *
     * @param \Renz\ModelBundle\Entity\Albumphoto $albumphotos
     */
    public function removeAlbumphoto(Albumphoto $albumphotos)
    {
    	$this->albumphotos->removeElement($albumphotos);
    }
    
    /**
     * Get albumphotos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbumphotos()
    {
    	return $this->albumphotos;
    }

    /**
     * Set titlear
     *
     * @param string $titlear
     * @return Album
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
}
