<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Availability
 * Purpose (each availability entity is connected with Room Entity, room availability will be determined after checking it from this entity class)
 *
 * @ORM\Table(name="availability")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\AvailabilityRepository")
 */
class Availability
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
     * @ORM\Column(name="day", type="date")
     * @Assert\NotBlank()
     */
    private $day;

    /**
     * @var integer
     * 
     * Room Quantity
     * 
     * @ORM\Column(name="qty", type="smallint", options={"default" = 0})
     */
    private $qty;

    /**
     * @var boolean
     * 
     * 1= Available
     * 0= Not Available
     *
     * @ORM\Column(name="isAvailable", type="boolean", options={"default" = 1})
     */
    private $isAvailable;

    /**
     * @var boolean
     * 
     * 1 = Refundable
     * 0 = Non Refundable
     * 
     * @ORM\Column(name="isRefundable", type="boolean", options={"default" = 1})
     */
    private $isRefundable;

    /**
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="availabilities")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     **/
    private $room;

    /**
     * @ORM\OneToOne(targetEntity="Rate")
     * @ORM\JoinColumn(name="rate_id", referencedColumnName="id")
     **/
    private $rate;

    /**
     * Constructor
     * 
     */
    public function __construct()
    {
        
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
     * Set day
     *
     * @param \DateTime $day
     * @return Availability
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set qty
     *
     * @param integer $qty
     * @return Availability
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return integer 
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return Availability
     */
    public function setIsAvailable($isAvailable)
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * Get isAvailable
     *
     * @return boolean 
     */
    public function getIsAvailable()
    {
        return $this->isAvailable;
    }

    /**
     * Set isRefundable
     *
     * @param boolean $isRefundable
     * @return Availability
     */
    public function setIsRefundable($isRefundable)
    {
        $this->isRefundable = $isRefundable;

        return $this;
    }

    /**
     * Get isRefundable
     *
     * @return boolean 
     */
    public function getIsRefundable()
    {
        return $this->isRefundable;
    }

    /**
     * Set room
     *
     * @param \Renz\ModelBundle\Entity\Room $room
     * @return Availability
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

    /**
     * Set rate
     *
     * @param \Renz\ModelBundle\Entity\Rate $rate
     * @return Availability
     */
    public function setRate(\Renz\ModelBundle\Entity\Rate $rate = null)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return \Renz\ModelBundle\Entity\Rate 
     */
    public function getRate()
    {
        return $this->rate;
    }
}
