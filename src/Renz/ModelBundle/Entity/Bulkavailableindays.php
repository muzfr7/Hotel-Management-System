<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bulkavailableindays
 * 
 * @ORM\Table(name="bulkavailableindays")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\BulkavailableindaysRepository")
 */
class Bulkavailableindays
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
     * @ORM\ManyToOne(targetEntity="Bulkavailable", inversedBy="bulkavailableindays")
     * @ORM\JoinColumn(name="bulkavailable_id", referencedColumnName="id")
     */
    protected $bulkavailable;
    
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
     * Set todate
     *
     * @param \DateTime $todate
     * @return Bulkavailableindays
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
     * @return Bulkavailableindays
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
     * Set bulkavailable
     *
     * @param \Renz\ModelBundle\Entity\Bulkavailable $bulkavailable
     * @return Bulkavailableindays
     */
    public function setBulkavailable(\Renz\ModelBundle\Entity\Bulkavailable $bulkavailable = null)
    {
        $this->bulkavailable = $bulkavailable;

        return $this;
    }

    /**
     * Get bulkavailable
     *
     * @return \Renz\ModelBundle\Entity\Bulkavailable 
     */
    public function getBulkavailable()
    {
        return $this->bulkavailable;
    }
}
