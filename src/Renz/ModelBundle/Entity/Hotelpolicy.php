<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hotelpolicy
 *
 * @ORM\Table(name="hotelpolicies")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\HotelpolicyRepository")
 */
class Hotelpolicy
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
     * @return Hotelpolicy
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
     * @return Hotelpolicy
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
     * Set status
     *
     * @param boolean $status
     * @return Hotelpolicy
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
     * @return Hotelpolicy
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
     * @return Hotelpolicy
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
