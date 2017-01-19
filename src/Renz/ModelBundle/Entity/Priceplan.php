<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Priceplan
 *
 * @ORM\Table(name="priceplan")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\PriceplanRepository")
 */
class Priceplan
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date")
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date")
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="sunday", type="decimal")
     */
    private $sunday;

    /**
     * @var string
     *
     * @ORM\Column(name="monday", type="decimal")
     */
    private $monday;

    /**
     * @var string
     *
     * @ORM\Column(name="tuesday", type="decimal")
     */
    private $tuesday;

    /**
     * @var string
     *
     * @ORM\Column(name="wednesday", type="decimal")
     */
    private $wednesday;

    /**
     * @var string
     *
     * @ORM\Column(name="thursday", type="decimal")
     */
    private $thursday;

    /**
     * @var string
     *
     * @ORM\Column(name="friday", type="decimal")
     */
    private $friday;

    /**
     * @var string
     *
     * @ORM\Column(name="saturday", type="decimal")
     */
    private $saturday;
	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="priceplans")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    protected $room;
    
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     * @return Priceplan
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Priceplan
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set sunday
     *
     * @param string $sunday
     * @return Priceplan
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return string 
     */
    public function getSunday()
    {
        return $this->sunday;
    }

    /**
     * Set monday
     *
     * @param string $monday
     * @return Priceplan
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return string 
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param string $tuesday
     * @return Priceplan
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return string 
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param string $wednesday
     * @return Priceplan
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return string 
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param string $thursday
     * @return Priceplan
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return string 
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param string $friday
     * @return Priceplan
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return string 
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param string $saturday
     * @return Priceplan
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return string 
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Priceplan
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
     * Set room
     *
     * @param \Renz\ModelBundle\Entity\Room $room
     * @return Priceplan
     */
    public function setRoom(\Renz\ModelBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Renz\ModelBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }
}
