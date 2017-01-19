<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Roomavailability
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\RoomavailabilityRepository")
 */
class Roomavailability
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
     * @ORM\OneToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     **/
    private $room;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;

    
    
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
     * Set qty
     *
     * @param integer $qty
     * @return Roomavailability
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
     * Set room
     *
     * @param \Renz\ModelBundle\Entity\Room $room
     * @return Roomavailability
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
