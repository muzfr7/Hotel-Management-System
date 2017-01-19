<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\NewsRepository")
 */
class News
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
     * @Assert\NotBlank()
     */
    private $titlear;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * 
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=600)
     * @Assert\NotBlank()
     * 
     */
    private $details;
    
    /**
     * @var string
     *
     * @ORM\Column(name="detailsar", type="string", length=600)
     * @Assert\NotBlank()
     *
     */
    private $detailsar;

    /**
     * @var string
     *
     * @ORM\Column(name="longDetails", type="text")
     * @Assert\NotBlank()
     */
    private $longDetails;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longDetailsar", type="text")
     * @Assert\NotBlank()
     */
    private $longDetailsar;

    /**
     * @var string
     *
     * @ORM\Column(name="createdBy", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;
	
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    	$this->updatedAt = new \DateTime();
    	$this->createdBy = "Administrator";
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
     * @return News
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
     * Set slug
     *
     * @param string $slug
     * @return News
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
     * Set details
     *
     * @param string $details
     * @return News
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
     * Set longDetails
     *
     * @param string $longDetails
     * @return News
     */
    public function setLongDetails($longDetails)
    {
        $this->longDetails = $longDetails;

        return $this;
    }

    /**
     * Get longDetails
     *
     * @return string 
     */
    public function getLongDetails()
    {
        return $this->longDetails;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     * @return News
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return News
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return News
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
     * Set status
     *
     * @param boolean $status
     * @return News
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
     * Set titlear
     *
     * @param string $titlear
     * @return News
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
     * Set detailsar
     *
     * @param string $detailsar
     * @return News
     */
    public function setDetailsar($detailsar)
    {
        $this->detailsar = $detailsar;

        return $this;
    }

    /**
     * Get detailsar
     *
     * @return string 
     */
    public function getDetailsar()
    {
        return $this->detailsar;
    }

    /**
     * Set longDetailsar
     *
     * @param string $longDetailsar
     * @return News
     */
    public function setLongDetailsar($longDetailsar)
    {
        $this->longDetailsar = $longDetailsar;

        return $this;
    }

    /**
     * Get longDetailsar
     *
     * @return string 
     */
    public function getLongDetailsar()
    {
        return $this->longDetailsar;
    }
}
