<?php

namespace Renz\ModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Room
 *
 * @ORM\Table(name="room")
 * @ORM\Entity(repositoryClass="Renz\ModelBundle\Entity\RoomRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Room
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
     * @Assert\NotBlank()
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="titlear", type="string", length=255)
     */
    private $titlear;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     * @Assert\NotBlank()
     */
    private $price;
    
    /**
     * @var float
     *
     * @ORM\Column(name="non_refundable_price", type="float", nullable=true)
     */
    private $nonRefundablePrice;
	
    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shortDetail", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $shortDetail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="shortDetailar", type="string", length=255)
     */
    private $shortDetailar;

    /**
     * @var string
     *
     * @ORM\Column(name="longDetail", type="text")
     * @Assert\NotBlank()
     */
    private $longDetail;
    
    /**
     * @var string
     *
     * @ORM\Column(name="longDetailar", type="text")
     */
    private $longDetailar;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facility", type="text")
     * @Assert\NotBlank()
     */
    private $facility;
    
    /**
     * @var string
     *
     * @ORM\Column(name="facilityar", type="text")
     */
    private $facilityar;

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
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="roomOrder", type="integer", nullable=true)
     */
    private $roomOrder;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="guestfavourite", type="boolean", nullable=true)
     */
    private $guestFavourite;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isAvailable", type="boolean", nullable=true)
     */
    private $isAvailable;
	
    private $temp;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @ORM\OneToMany(targetEntity="Photo", mappedBy="room")
     */
    protected $photos;
    
    /**
     * @ORM\OneToMany(targetEntity="Condit", mappedBy="room")
     */
    protected $condits;
    
    /**
     * @ORM\OneToMany(targetEntity="Priceplan", mappedBy="room")
     */
    protected $priceplans;
    
    /**
     * @ORM\OneToMany(targetEntity="Booking", mappedBy="room")
     */
    protected $bookings;
    
    /**
     * @ORM\ManyToMany(targetEntity="Roomclosure", mappedBy="room")
     **/
    protected $roomclosure;

    /**
     * @ORM\OneToMany(targetEntity="Availability", mappedBy="room")
     **/
    private $availabilities;
    
    /**
     * Constructor
     * 
     */
    public function __construct()
    {
    	$this->updatedAt = new \DateTime();
    	//$this->slug = "Room".rand(1, 10);
    	
    	$this->photos = new ArrayCollection();
    	$this->condits = new ArrayCollection();
    	
    	$this->priceplans = new ArrayCollection();
    	
    	$this->roomclosure = new ArrayCollection();

        $this->availabilities = new ArrayCollection();
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
     * @return Room
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Room
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Room
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceString
     *
     * @param string $priceString
     * @return Room
     */
    public function setPriceString($priceString)
    {
        $this->priceString = $priceString;

        return $this;
    }

    /**
     * Get priceString
     *
     * @return string 
     */
    public function getPriceString()
    {
        return $this->priceString;
    }
	
    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Room
     */
    public function setQuantity($quantity)
    {
    	$this->quantity = $quantity;
    
    	return $this;
    }
    
    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
    	return $this->quantity;
    }
    
    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return Room
     */
    public function setCapacity($capacity)
    {
    	$this->capacity = $capacity;
    
    	return $this;
    }
    
    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
    	return $this->capacity;
    }
    
    /**
     * Set shortDetail
     *
     * @param string $shortDetail
     * @return Room
     */
    public function setShortDetail($shortDetail)
    {
        $this->shortDetail = $shortDetail;

        return $this;
    }

    /**
     * Get shortDetail
     *
     * @return string 
     */
    public function getShortDetail()
    {
        return $this->shortDetail;
    }

    /**
     * Set longDetail
     *
     * @param string $longDetail
     * @return Room
     */
    public function setLongDetail($longDetail)
    {
        $this->longDetail = $longDetail;

        return $this;
    }

    /**
     * Get longDetail
     *
     * @return string 
     */
    public function getLongDetail()
    {
        return $this->longDetail;
    }
    
    /**
     * Set facility
     *
     * @param string $facility
     * @return Room
     */
    public function setFacility($facility)
    {
    	$this->facility = $facility;
    
    	return $this;
    }
    
    /**
     * Get facility
     *
     * @return string
     */
    public function getFacility()
    {
    	return $this->facility;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Room
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
     * @return Room
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
     * Set status
     *
     * @param boolean $status
     * @return Room
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
     * Set roomOrder
     *
     * @param integer $roomOrder
     * @return Room
     */
    public function setRoomOrder($roomOrder)
    {
    	$this->roomOrder = $roomOrder;
    
    	return $this;
    }
    
    /**
     * Get roomOrder
     *
     * @return integer
     */
    public function getRoomOrder()
    {
    	return $this->roomOrder;
    }
    
    /**
     * Set guestFavourite
     *
     * @param boolean $guestFavourite
     * @return Room
     */
    public function setGuestFavourite($guestFavourite)
    {
    	$this->guestFavourite = $guestFavourite;
    
    	return $this;
    }
    
    /**
     * Get guestFavourite
     *
     * @return boolean
     */
    public function getGuestFavourite()
    {
    	return $this->guestFavourite;
    }
    
    /**
     * Set isAvailable
     *
     * @param boolean $isAvailable
     * @return Room
     */
    public function setIsAvailable($isAvailable)
    {
    	$this->isAvailable = $isAvailable;
    
    	return $this;
    }
    
    /**
     * Get isAvailable
     *
     * @return boolean
     */
    public function getIsAvailable()
    {
    	return $this->isAvailable;
    }
    
    /**
     * Add photos
     *
     * @param \Renz\ModelBundle\Entity\Photo $photos
     * @return Room
     */
    public function addPhoto(Photo $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \Renz\ModelBundle\Entity\Photo $photos
     */
    public function removePhoto(Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add condits
     *
     * @param \Renz\ModelBundle\Entity\Condit $condits
     * @return Room
     */
    public function addCondit(\Renz\ModelBundle\Entity\Condit $condits)
    {
        $this->condits[] = $condits;

        return $this;
    }

    /**
     * Remove condits
     *
     * @param \Renz\ModelBundle\Entity\Condit $condits
     */
    public function removeCondit(\Renz\ModelBundle\Entity\Condit $condits)
    {
        $this->condits->removeElement($condits);
    }

    /**
     * Get condits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCondits()
    {
        return $this->condits;
    }
    
    
    /********/
    
    
    public function getAbsolutePath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadRootDir().'/'.$this->path;
    }
    
    public function getWebPath()
    {
    	return null === $this->path
    	? null
    	: $this->getUploadDir().'/'.$this->path;
    }
    
    protected function getUploadRootDir()
    {
    	// the absolute directory path where uploaded
    	// documents should be saved
    	return __DIR__.'/../../../../public_html/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    	// get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/rooms_main';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
    	$this->file = $file;
    	// check if we have an old image path
    	if (isset($this->path)) {
    		// store the old name to delete after the update
    		$this->temp = $this->path;
    		$this->path = null;
    	} else {
    		$this->path = 'initial';
    	}
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
    	return $this->file;
    }
    
    
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
    	if (null !== $this->getFile()) {
    		// do whatever you want to generate a unique name
    		$filename = sha1(uniqid(mt_rand(), true));
    		$this->path = $filename.'.'.$this->getFile()->guessExtension();
    	}
    }
    
    
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
    	if (null === $this->getFile()) {
    		return;
    	}
    
    	// if there is an error when moving the file, an exception will
    	// be automatically thrown by move(). This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->getFile()->move($this->getUploadRootDir(), $this->path);
    
    	// check if we have an old image
    	if (isset($this->temp)) {
    		// delete the old image
    		unlink($this->getUploadRootDir().'/'.$this->temp);
    		// clear the temp image path
    		$this->temp = null;
    	}
    	$this->file = null;
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
    	if ($file = $this->getAbsolutePath()) {
    		unlink($file);
    	}
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Room
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Add priceplans
     *
     * @param \Renz\ModelBundle\Entity\Priceplan $priceplans
     * @return Room
     */
    public function addPriceplan(\Renz\ModelBundle\Entity\Priceplan $priceplans)
    {
        $this->priceplans[] = $priceplans;

        return $this;
    }

    /**
     * Remove priceplans
     *
     * @param \Renz\ModelBundle\Entity\Priceplan $priceplans
     */
    public function removePriceplan(\Renz\ModelBundle\Entity\Priceplan $priceplans)
    {
        $this->priceplans->removeElement($priceplans);
    }

    /**
     * Get priceplans
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPriceplans()
    {
        return $this->priceplans;
    }

    /**
     * Add bookings
     *
     * @param \Renz\ModelBundle\Entity\Booking $bookings
     * @return Room
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
     * Set nonRefundablePrice
     *
     * @param float $nonRefundablePrice
     * @return Room
     */
    public function setNonRefundablePrice($nonRefundablePrice)
    {
        $this->nonRefundablePrice = $nonRefundablePrice;

        return $this;
    }

    /**
     * Get nonRefundablePrice
     *
     * @return float 
     */
    public function getNonRefundablePrice()
    {
        return $this->nonRefundablePrice;
    }
    
    /**
     * Add roomclosure
     *
     * @param \Renz\ModelBundle\Entity\Roomclosure $roomclosure
     * @return Room
     */
    public function addRoomclosure(\Renz\ModelBundle\Entity\Roomclosure $roomclosure)
    {
        $this->roomclosure[] = $roomclosure;

        return $this;
    }
	
    /**
     * Remove roomclosure
     *
     * @param \Renz\ModelBundle\Entity\Roomclosure $roomclosure
     */
    public function removeRoomclosure(\Renz\ModelBundle\Entity\Roomclosure $roomclosure)
    {
        $this->roomclosure->removeElement($roomclosure);
    }
	
    /**
     * Get roomclosures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoomclosure()
    {
        return $this->roomclosure;
    }

    /**
     * Set titlear
     *
     * @param string $titlear
     * @return Room
     */
    public function setTitlear($titlear)
    {
        $this->titlear = $titlear;

        return $this;
    }

    /**
     * Get titlear
     *
     * @return string 
     */
    public function getTitlear()
    {
        return $this->titlear;
    }

    /**
     * Set shortDetailar
     *
     * @param string $shortDetailar
     * @return Room
     */
    public function setShortDetailar($shortDetailar)
    {
        $this->shortDetailar = $shortDetailar;

        return $this;
    }

    /**
     * Get shortDetailar
     *
     * @return string 
     */
    public function getShortDetailar()
    {
        return $this->shortDetailar;
    }

    /**
     * Set longDetailar
     *
     * @param string $longDetailar
     * @return Room
     */
    public function setLongDetailar($longDetailar)
    {
        $this->longDetailar = $longDetailar;

        return $this;
    }

    /**
     * Get longDetailar
     *
     * @return string 
     */
    public function getLongDetailar()
    {
        return $this->longDetailar;
    }

    /**
     * Set facilityar
     *
     * @param string $facilityar
     * @return Room
     */
    public function setFacilityar($facilityar)
    {
        $this->facilityar = $facilityar;

        return $this;
    }

    /**
     * Get facilityar
     *
     * @return string 
     */
    public function getFacilityar()
    {
        return $this->facilityar;
    }

    /**
     * Add availability
     *
     * @param \Renz\ModelBundle\Entity\Availability $availabilities
     * @return Room
     */
    public function addAvailability(\Renz\ModelBundle\Entity\Availability $availabilities)
    {
        $this->availabilities[] = $availabilities;

        return $this;
    }

    /**
     * Remove availability
     *
     * @param \Renz\ModelBundle\Entity\Availability $availabilities
     */
    public function removeAvailability(\Renz\ModelBundle\Entity\Availability $availabilities)
    {
        $this->availabilities->removeElement($availabilities);
    }

    /**
     * set availabilities
     *
     * @param \Renz\ModelBundle\Entity\Availability $availabilities
     * @return Room
     */
    public function setAvailabilities(\Renz\ModelBundle\Entity\Availability $availabilities = null)
    {
        $this->availabilities[] = $availabilities;
        return $this;
    }

    /**
     * Get availabilities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAvailabilities()
    {
        return $this->availabilities;
    }
}
