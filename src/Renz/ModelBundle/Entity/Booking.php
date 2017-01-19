<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\BookingRepository")
 */
class Booking
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
     * @var integer
     *
     * @ORM\Column(name="guests", type="integer")
     * @Assert\NotBlank()
     */
    private $guests;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_checkin", type="datetime")
     * @Assert\NotBlank()
     */
    private $dateCheckin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_checkout", type="datetime")
     * @Assert\NotBlank()
     */
    private $dateCheckout;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_days", type="integer")
     * @Assert\NotBlank()
     */
    private $totalDays;

    /**
     * @var string
     *
     * @ORM\Column(name="special_requests", type="string", length=600, nullable=true)
     */
    private $specialRequests;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=50, nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="cardnumber", type="string", length=255)
     * @Assert\NotBlank()
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cardownername", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $cardownername;
	
    /**
     * @ORM\ManyToOne(targetEntity="Room", inversedBy="bookings")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     */
    protected $room;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cardtype")
     * @ORM\JoinColumn(name="cardtype_id", referencedColumnName="id")
     **/
    protected $cardtype;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bookingstatus")
     * @ORM\JoinColumn(name="bookingstatus_id", referencedColumnName="id")
     **/
    protected $bookingstatus;
    
    /**
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     **/
    protected $country;
    
    /**
     * @var float
     *
     * @ORM\Column(name="totalprice", type="float")
     * @Assert\NotBlank()
     */
    private $totalprice;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="pricecategory", type="integer")
     * @Assert\NotBlank()
     */
    private $pricecategory;
    
    /**
     * @var string
     *
     * @ORM\Column(name="bookingreference", type="string", length=255, nullable=true)
     */
    private $bookingreference;
    
    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="bookings")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     **/
    private $customer;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bookingstatuscustomer")
     * @ORM\JoinColumn(name="bookingstatuscustomer_id", referencedColumnName="id")
     **/
    protected $bookingstatuscustomer;
    
    /**
     * Constructor
     *
     */
    public function __construct()
    {
    	$this->updatedAt = new \DateTime();
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
     * Set guests
     *
     * @param integer $guests
     * @return Booking
     */
    public function setGuests($guests)
    {
    	$this->guests = $guests;
    
    	return $this;
    }
    
    /**
     * Get guests
     *
     * @return integer
     */
    public function getGuests()
    {
    	return $this->guests;
    }

    /**
     * Set dateCheckin
     *
     * @param \DateTime $dateCheckin
     * @return Booking
     */
    public function setDateCheckin($dateCheckin)
    {
        $this->dateCheckin = $dateCheckin;

        return $this;
    }

    /**
     * Get dateCheckin
     *
     * @return \DateTime 
     */
    public function getDateCheckin()
    {
        return $this->dateCheckin;
    }

    /**
     * Set dateCheckout
     *
     * @param \DateTime $dateCheckout
     * @return Booking
     */
    public function setDateCheckout($dateCheckout)
    {
        $this->dateCheckout = $dateCheckout;

        return $this;
    }

    /**
     * Get dateCheckout
     *
     * @return \DateTime 
     */
    public function getDateCheckout()
    {
        return $this->dateCheckout;
    }

    /**
     * Set totalDays
     *
     * @param integer $totalDays
     * @return Booking
     */
    public function setTotalDays($totalDays)
    {
        $this->totalDays = $totalDays;

        return $this;
    }

    /**
     * Get totalDays
     *
     * @return integer 
     */
    public function getTotalDays()
    {
        return $this->totalDays;
    }

    /**
     * Set specialRequests
     *
     * @param string $specialRequests
     * @return Booking
     */
    public function setSpecialRequests($specialRequests)
    {
        $this->specialRequests = $specialRequests;

        return $this;
    }

    /**
     * Get specialRequests
     *
     * @return string 
     */
    public function getSpecialRequests()
    {
        return $this->specialRequests;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Booking
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
     * @return Booking
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
     * Set email
     *
     * @param string $email
     * @return Booking
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
     * Set address
     *
     * @param string $address
     * @return Booking
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
     * @return Booking
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
     * Set zipcode
     *
     * @param string $zipcode
     * @return Booking
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Booking
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
     * Set cardnumber
     *
     * @param string $cardnumber
     * @return Booking
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Booking
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Booking
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
	
    /**
     * Set cardownername
     *
     * @param string $cardownername
     * @return Booking
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
     * Set room
     *
     * @param \Renz\ModelBundle\Entity\Room $room
     * @return Booking
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
     * Set cardtype
     *
     * @param \Renz\ModelBundle\Entity\Cardtype $cardtype
     * @return Booking
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
     * Set bookingstatus
     *
     * @param \Renz\ModelBundle\Entity\Bookingstatus $bookingstatus
     * @return Booking
     */
    public function setBookingstatus(\Renz\ModelBundle\Entity\Bookingstatus $bookingstatus = null)
    {
        $this->bookingstatus = $bookingstatus;

        return $this;
    }

    /**
     * Get bookingstatus
     *
     * @return \Renz\ModelBundle\Entity\Bookingstatus 
     */
    public function getBookingstatus()
    {
        return $this->bookingstatus;
    }

    /**
     * Set country
     *
     * @param \Renz\ModelBundle\Entity\Country $country
     * @return Booking
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
     * Set totalprice
     *
     * @param float $totalprice
     * @return Room
     */
    public function setTotalprice($totalprice)
    {
    	$this->totalprice = $totalprice;
    
    	return $this;
    }
    
    /**
     * Get totalprice
     *
     * @return float
     */
    public function getTotalprice()
    {
    	return $this->totalprice;
    }
    
    /**
     * Set pricecategory
     *
     * @param integer $pricecategory
     * @return Booking
     */
    public function setPricecategory($pricecategory)
    {
    	$this->pricecategory = $pricecategory;
    
    	return $this;
    }
    
    /**
     * Get pricecategory
     *
     * @return integer
     */
    public function getPricecategory()
    {
    	return $this->pricecategory;
    }
    
    /**
     * Set bookingreference
     *
     * @param string $lastname
     * @return Booking
     */
    public function setBookingreference($bookingreference)
    {
    	$this->bookingreference = $bookingreference;
    
    	return $this;
    }
    
    /**
     * Get bookingreference
     *
     * @return string
     */
    public function getBookingreference()
    {
    	return $this->bookingreference;
    }

    /**
     * Set customer
     *
     * @param \Renz\ModelBundle\Entity\Customer $customer
     * @return Booking
     */
    public function setCustomer(\Renz\ModelBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \Renz\ModelBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set bookingstatuscustomer
     *
     * @param \Renz\ModelBundle\Entity\Bookingstatuscustomer $bookingstatuscustomer
     * @return Booking
     */
    public function setBookingstatuscustomer(\Renz\ModelBundle\Entity\Bookingstatuscustomer $bookingstatuscustomer = null)
    {
        $this->bookingstatuscustomer = $bookingstatuscustomer;

        return $this;
    }

    /**
     * Get bookingstatuscustomer
     *
     * @return \Renz\ModelBundle\Entity\Bookingstatuscustomer 
     */
    public function getBookingstatuscustomer()
    {
        return $this->bookingstatuscustomer;
    }
}
