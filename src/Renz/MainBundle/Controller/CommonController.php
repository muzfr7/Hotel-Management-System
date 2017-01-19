<?php
namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @author Muzafar
 * @Route("/{_locale}/common", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 *
 */
class CommonController extends Controller
{
    /**
     * Common address block used in most frontend places
     * 
     * @Route("/address")
     * @Template()
     */
    public function addressAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Cms')->find(6);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Cms entity.');
    	}
    	return array(
    		'common'      => $entity,
    	);
    }
    
    /**
     * Last 3 news for footer
     * 
     * @Route("/last-three-news")
     * @Template()
     */
    public function last3newsAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entities = $em->getRepository('ModelBundle:News')->findLastThree();
    	if (!$entities) {
    		throw $this->createNotFoundException('Unable to find News entity.');
    	}
    	return array(
    		'entities'      => $entities,
    	);
    }
    
    /**
     * About us page details around 400 letters.. max
     *
     * @Route("/aboutus-max-400")
     * @Template()
     */
    public function aboutusmax400Action()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Cms')->find(1);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Cms entity.');
    	}
    	return array(
    		'entity'      => $entity,
    	);
    }
    
    /**
     * Room Listing for top menu
     *
     * @Route("/topnav-room-list")
     * @Template()
     */
    public function topnavroomlistAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Room')->findAllActive();
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Room entity.');
    	}
    	return array(
    		'rooms'      => $entity,
    	);
    }
    
    /**
     * Room Listing for home page booking room type
     *
     * @Route("/homepage-booking-room-list")
     * @Template()
     */
    public function homepagebookingroomlistAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Room')->findAllActive();
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Room entity.');
    	}
    	return array(
    			'rooms'      => $entity,
    	);
    }
    
    /**
     * last 3 guest favourite rooms
     *
     * @Route("/guest-favourite-rooms")
     * @Template()
     */
    public function guestfavouriteAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Room')->findAllActiveGuestFavourite();
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Room entity.');
    	}
    	return array(
    		'favouriterooms'      => $entity,
    	);
    }
    
    /**
     * Display Gallery Highlights photos
     *
     * @Route("/gallery-highlights")
     * @Template()
     */
    public function galleryhighlightsAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Photo')->findAllActiveGalleryHighlights();
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Photo entity.');
    	}
    	return array(
    		'galleryhighlights' => $entity,
    	);
    }

    /**
     * Common facilities at renz hotel block
     * 
     * @Route("/facilitiesatrenzhotel")
     * @Template()
     */
    public function facilitiesatrenzhotelAction()
    {
        return array();
    }
}