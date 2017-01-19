<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roompolicy
 *
 * @ORM\Table(name="roompolicies")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\RoompolicyRepository")
 */
class Roompolicy
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
     * @ORM\Column(name="detail", type="text")
     */
    private $detail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="detailar", type="text")
     */
    private $detailar;

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
     * @return Roompolicy
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
     * Set detail
     *
     * @param string $detail
     * @return Roompolicy
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail
     *
     * @return string 
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Roompolicy
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
     * @return Roompolicy
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
     * Set titlear
     *
     * @param string $titlear
     * @return Roompolicy
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
     * Set detailar
     *
     * @param string $detailar
     * @return Roompolicy
     */
    public function setDetailar($detailar)
    {
        $this->detailar = $detailar;

        return $this;
    }

    /**
     * Get detailar
     *
     * @return string 
     */
    public function getDetailar()
    {
        return $this->detailar;
    }
}
