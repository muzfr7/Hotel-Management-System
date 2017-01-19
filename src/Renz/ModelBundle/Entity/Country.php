<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="code", type="string", length=20)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="shortname", type="string", length=80)
     */
    private $shortname;

    /**
     * @var string
     *
     * @ORM\Column(name="longname", type="string", length=80)
     */
    private $longname;

    /**
     * @var string
     *
     * @ORM\Column(name="callingcode", type="string", length=8)
     */
    private $callingcode;
    
    /**
     * Product ID
     *
     * @return string
     */
    public function __toString()
    {
    	return strval($this->shortname);
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
     * Set code
     *
     * @param string $code
     * @return Country
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     * @return Country
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string 
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set longname
     *
     * @param string $longname
     * @return Country
     */
    public function setLongname($longname)
    {
        $this->longname = $longname;

        return $this;
    }

    /**
     * Get longname
     *
     * @return string 
     */
    public function getLongname()
    {
        return $this->longname;
    }

    /**
     * Set callingcode
     *
     * @param string $callingcode
     * @return Country
     */
    public function setCallingcode($callingcode)
    {
        $this->callingcode = $callingcode;

        return $this;
    }

    /**
     * Get callingcode
     *
     * @return string 
     */
    public function getCallingcode()
    {
        return $this->callingcode;
    }
}
