<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\CustomerRepository")
 */
class Customer implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    private $email;
	
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;
    
    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $city;
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $zip;
    
    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     **/
    protected $country;
    
    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $mobile;
    
    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $cardownername;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cardtype")
     * @ORM\JoinColumn(name="cardtype_id", referencedColumnName="id")
     **/
    protected $cardtype;
    
    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $cardnumber;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cardmonth")
     * @ORM\JoinColumn(name="cardmonth_id", referencedColumnName="id")
     **/
    private $expiryMonth;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cardyear")
     * @ORM\JoinColumn(name="cardyear_id", referencedColumnName="id")
     **/
    private $expiryYear;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="customer")
     **/
    private $bookings;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $passwordresetcode;

    public function __construct()
    {
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
        $this->bookings = new ArrayCollection();
    }
    
    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Customer
     */
    public function setFirstname($firstname)
    {
    	$this->firstname = $firstname;
    
    	return $this;
    }
    
    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
    	return $this->firstname;
    }
    
    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Customer
     */
    public function setLastname($lastname)
    {
    	$this->lastname = $lastname;
    
    	return $this;
    }
    
    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
    	return $this->lastname;
    }
    
    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    
    
    
    public function isAccountNonExpired()
    {
    	return true;
    }
    
    public function isAccountNonLocked()
    {
    	return true;
    }
    
    public function isCredentialsNonExpired()
    {
    	return true;
    }
    
    public function isEnabled()
    {
    	return $this->isActive;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Customer
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Customer
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set cardownername
     *
     * @param string $cardownername
     * @return Customer
     */
    public function setCardownername($cardownername)
    {
        $this->cardownername = $cardownername;

        return $this;
    }

    /**
     * Get cardownername
     *
     * @return string 
     */
    public function getCardownername()
    {
        return $this->cardownername;
    }

    /**
     * Set cardnumber
     *
     * @param string $cardnumber
     * @return Customer
     */
    public function setCardnumber($cardnumber)
    {
        $this->cardnumber = $cardnumber;

        return $this;
    }

    /**
     * Get cardnumber
     *
     * @return string 
     */
    public function getCardnumber()
    {
        return $this->cardnumber;
    }

    /**
     * Set country
     *
     * @param \Renz\ModelBundle\Entity\Country $country
     * @return Customer
     */
    public function setCountry(\Renz\ModelBundle\Entity\Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Renz\ModelBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set cardtype
     *
     * @param \Renz\ModelBundle\Entity\Cardtype $cardtype
     * @return Customer
     */
    public function setCardtype(\Renz\ModelBundle\Entity\Cardtype $cardtype = null)
    {
        $this->cardtype = $cardtype;

        return $this;
    }

    /**
     * Get cardtype
     *
     * @return \Renz\ModelBundle\Entity\Cardtype 
     */
    public function getCardtype()
    {
        return $this->cardtype;
    }

    /**
     * Set expiryMonth
     *
     * @param \Renz\ModelBundle\Entity\Cardmonth $expiryMonth
     * @return Customer
     */
    public function setExpiryMonth(\Renz\ModelBundle\Entity\Cardmonth $expiryMonth = null)
    {
        $this->expiryMonth = $expiryMonth;

        return $this;
    }

    /**
     * Get expiryMonth
     *
     * @return \Renz\ModelBundle\Entity\Cardmonth 
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * Set expiryYear
     *
     * @param \Renz\ModelBundle\Entity\Cardyear $expiryYear
     * @return Customer
     */
    public function setExpiryYear(\Renz\ModelBundle\Entity\Cardyear $expiryYear = null)
    {
        $this->expiryYear = $expiryYear;

        return $this;
    }

    /**
     * Get expiryYear
     *
     * @return \Renz\ModelBundle\Entity\Cardyear 
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * Add bookings
     *
     * @param \Renz\ModelBundle\Entity\Booking $bookings
     * @return Customer
     */
    public function addBooking(\Renz\ModelBundle\Entity\Booking $bookings)
    {
        $this->bookings[] = $bookings;

        return $this;
    }

    /**
     * Remove bookings
     *
     * @param \Renz\ModelBundle\Entity\Booking $bookings
     */
    public function removeBooking(\Renz\ModelBundle\Entity\Booking $bookings)
    {
        $this->bookings->removeElement($bookings);
    }

    /**
     * Get bookings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookings()
    {
        return $this->bookings;
    }
    
    /**
     * Set passwordresetcode
     *
     * @param string $passwordresetcode
     * @return Customer
     */
    public function setPasswordresetcode($passwordresetcode)
    {
    	$this->passwordresetcode = $passwordresetcode;
    
    	return $this;
    }
    
    /**
     * Get passwordresetcode
     *
     * @return string
     */
    public function getPasswordresetcode()
    {
    	return $this->passwordresetcode;
    }
}
