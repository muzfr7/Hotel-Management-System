<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cms
 *
 * @ORM\Table(name="cms")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\CmsRepository")
 */
class Cms
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
     * 
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
     * @ORM\Column(name="longDetail", type="text")
     * @Assert\NotBlank()
     */
    private $longDetail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longDetailar", type="text")
     * 
     */
    private $longDetailar;

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
     * @return Cms
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
     * Set longDetail
     *
     * @param string $longDetail
     * @return Cms
     */
    public function setLongDetail($longDetail)
    {
        $this->longDetail = $longDetail;

        return $this;
    }

    /**
     * Get longDetail
     *
     * @return string 
     */
    public function getLongDetail()
    {
        return $this->longDetail;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Cms
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
     * @return Cms
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
     * Set longDetailar
     *
     * @param string $longDetailar
     * @return Cms
     */
    public function setLongDetailar($longDetailar)
    {
        $this->longDetailar = $longDetailar;

        return $this;
    }

    /**
     * Get longDetailar
     *
     * @return string 
     */
    public function getLongDetailar()
    {
        return $this->longDetailar;
    }
}
