<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Bulkavailable
 *
 * @ORM\Table(name="bulkavailable")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\BulkavailableRepository")
 */
class Bulkavailable
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
     * @ORM\Column(name="fromdate", type="date")
     */
    private $fromdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="todate", type="date")
     */
    private $todate;

    /**
     * @var integer
     *
     * @ORM\Column(name="qty", type="integer", nullable=true)
     */
    private $qty;
	
    /**
     * @ORM\OneToOne(targetEntity="Room")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     **/
    private $room;
    
    /**
     * @ORM\OneToMany(targetEntity="Bulkavailableindays", mappedBy="bulkavailable")
     */
    protected $bulkavailableindays;
    
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    	$this->bulkavailables = new ArrayCollection();
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
     * Set fromdate
     *
     * @param \DateTime $fromdate
     * @return Bulkavailable
     */
    public function setFromdate($fromdate)
    {
        $this->fromdate = $fromdate;

        return $this;
    }

    /**
     * Get fromdate
     *
     * @return \DateTime 
     */
    public function getFromdate()
    {
        return $this->fromdate;
    }

    /**
     * Set todate
     *
     * @param \DateTime $todate
     * @return Bulkavailable
     */
    public function setTodate($todate)
    {
        $this->todate = $todate;

        return $this;
    }

    /**
     * Get todate
     *
     * @return \DateTime 
     */
    public function getTodate()
    {
        return $this->todate;
    }

    /**
     * Set qty
     *
     * @param integer $qty
     * @return Bulkavailable
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
     * @return Bulkavailable
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
     * Add bulkavailableindays
     *
     * @param \Renz\ModelBundle\Entity\Bulkavailableindays $bulkavailableindays
     * @return Bulkavailable
     */
    public function addBulkavailableinday(\Renz\ModelBundle\Entity\Bulkavailableindays $bulkavailableindays)
    {
        $this->bulkavailableindays[] = $bulkavailableindays;

        return $this;
    }

    /**
     * Remove bulkavailableindays
     *
     * @param \Renz\ModelBundle\Entity\Bulkavailableindays $bulkavailableindays
     */
    public function removeBulkavailableinday(\Renz\ModelBundle\Entity\Bulkavailableindays $bulkavailableindays)
    {
        $this->bulkavailableindays->removeElement($bulkavailableindays);
    }

    /**
     * Get bulkavailableindays
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBulkavailableindays()
    {
        return $this->bulkavailableindays;
    }
}
