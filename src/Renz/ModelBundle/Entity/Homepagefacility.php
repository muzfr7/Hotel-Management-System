<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepagefacility
 *
 * @ORM\Table(name="homepage_facilities")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\HomepagefacilityRepository")
 */
class Homepagefacility
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
     * @var string
     *
     * @ORM\Column(name="longDetail", type="text")
     */
    private $longDetail;

    /**
     * @var string
     *
     * @ORM\Column(name="longDetailar", type="text")
     */
    private $longDetailar;

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
     * @return Homepagefacility
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
     * Set titlear
     *
     * @param string $titlear
     * @return Homepagefacility
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
     * @return Homepagefacility
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
     * @return Homepagefacility
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

    /**
     * Set longDetail
     *
     * @param string $longDetail
     * @return Homepagefacility
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
     * Set longDetailar
     *
     * @param string $longDetailar
     * @return Homepagefacility
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Homepagefacility
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
     * @return Homepagefacility
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
}
