<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cardtype
 *
 * @ORM\Table(name="cardyear")
 * @ORM\Entity()
 */
class Cardyear
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
     * Constructor
     *
     */
    public function __construct()
    {
    	
    }
    
    /**
     * Product ID
     *
     * @return string
     */
    public function __toString()
    {
    	return strval($this->title);
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
     * Set title
     *
     * @param string $title
     * @return Cardtype
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
}
