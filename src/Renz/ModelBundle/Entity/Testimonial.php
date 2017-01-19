<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Testimonial
 *
 * @ORM\Table(name="testimonial")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\TestimonialRepository")
 */
class Testimonial
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
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fullnamear", type="string", length=255)
     */
    private $fullnamear;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=800)
     */
    private $comment;
    
    /**
     * @var string
     *
     * @ORM\Column(name="commentar", type="string", length=800)
     */
    private $commentar;

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
     * Set fullname
     *
     * @param string $fullname
     * @return Testimonial
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Testimonial
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Testimonial
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
     * @return Testimonial
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
     * Set fullnamear
     *
     * @param string $fullnamear
     * @return Testimonial
     */
    public function setFullnamear($fullnamear)
    {
        $this->fullnamear = $fullnamear;

        return $this;
    }

    /**
     * Get fullnamear
     *
     * @return string 
     */
    public function getFullnamear()
    {
        return $this->fullnamear;
    }

    /**
     * Set commentar
     *
     * @param string $commentar
     * @return Testimonial
     */
    public function setCommentar($commentar)
    {
        $this->commentar = $commentar;

        return $this;
    }

    /**
     * Get commentar
     *
     * @return string 
     */
    public function getCommentar()
    {
        return $this->commentar;
    }
}
