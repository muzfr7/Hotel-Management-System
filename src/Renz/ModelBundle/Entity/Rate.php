<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\RateRepository")
 */
class Rate
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
     * @var float
     *
     * @ORM\Column(name="rateRefundable", type="float")
     * @Assert\NotBlank()
     */
    private $rateRefundable;

    /**
     * @var float
     *
     * @ORM\Column(name="rateNonRefundable", type="float")
     * @Assert\NotBlank()
     */
    private $rateNonRefundable;

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
     * Set rateRefundable
     *
     * @param float $rateRefundable
     * @return Rate
     */
    public function setRateRefundable($rateRefundable)
    {
        $this->rateRefundable = $rateRefundable;

        return $this;
    }

    /**
     * Get rateRefundable
     *
     * @return float 
     */
    public function getRateRefundable()
    {
        return $this->rateRefundable;
    }

    /**
     * Set rateNonRefundable
     *
     * @param float $rateNonRefundable
     * @return Rate
     */
    public function setRateNonRefundable($rateNonRefundable)
    {
        $this->rateNonRefundable = $rateNonRefundable;

        return $this;
    }

    /**
     * Get rateNonRefundable
     *
     * @return float 
     */
    public function getRateNonRefundable()
    {
        return $this->rateNonRefundable;
    }
}
