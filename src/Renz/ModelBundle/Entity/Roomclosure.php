<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Roomclosure
 *
 * @ORM\Table(name="roomclosure")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\RoomclosureRepository")
 */
class Roomclosure
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closefrom", type="date")
     * @Assert\NotBlank()
     */
    protected $closefrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="closeto", type="date")
     * @Assert\NotBlank()
     */
    protected $closeto;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_available_standard", type="boolean", nullable=true)
     */
    protected $isAvailableStandard;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_available_non_refundable", type="boolean", nullable=true)
     */
    protected $isAvailableNonRefundable;
    
    /**
     * @ORM\ManyToMany(targetEntity="Room", inversedBy="roomclosure")
     * @ORM\JoinTable(name="roomclosure_room")
     **/
    protected $room;
    
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    	$this->room = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set closefrom
     *
     * @param \DateTime $closefrom
     * @return Roomclosure
     */
    public function setClosefrom($closefrom)
    {
        $this->closefrom = $closefrom;

        return $this;
    }

    /**
     * Get closefrom
     *
     * @return \DateTime 
     */
    public function getClosefrom()
    {
        return $this->closefrom;
    }

    /**
     * Set closeto
     *
     * @param \DateTime $closeto
     * @return Roomclosure
     */
    public function setCloseto($closeto)
    {
        $this->closeto = $closeto;

        return $this;
    }

    /**
     * Get closeto
     *
     * @return \DateTime 
     */
    public function getCloseto()
    {
        return $this->closeto;
    }

    /**
     * Set isAvailableStandard
     *
     * @param boolean $isAvailableStandard
     * @return Roomclosure
     */
    public function setIsAvailableStandard($isAvailableStandard)
    {
        $this->isAvailableStandard = $isAvailableStandard;

        return $this;
    }

    /**
     * Get isAvailableStandard
     *
     * @return boolean 
     */
    public function getIsAvailableStandard()
    {
        return $this->isAvailableStandard;
    }

    /**
     * Set isAvailableNonRefundable
     *
     * @param boolean $isAvailableNonRefundable
     * @return Roomclosure
     */
    public function setIsAvailableNonRefundable($isAvailableNonRefundable)
    {
        $this->isAvailableNonRefundable = $isAvailableNonRefundable;

        return $this;
    }

    /**
     * Get isAvailableNonRefundable
     *
     * @return boolean 
     */
    public function getIsAvailableNonRefundable()
    {
        return $this->isAvailableNonRefundable;
    }
    
    

    /**
     * Add room
     *
     * @param \Renz\ModelBundle\Entity\Room $room
     * @return Roomclosure
     */
    public function addRoom(\Renz\ModelBundle\Entity\Room $room)
    {
        $this->room[] = $room;

        return $this;
    }

    /**
     * Remove room
     *
     * @param \Renz\ModelBundle\Entity\Room $room
     */
    public function removeRoom(\Renz\ModelBundle\Entity\Room $room)
    {
        $this->room->removeElement($room);
    }

    /**
     * Get room
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoom()
    {
        return $this->room;
    }
}
