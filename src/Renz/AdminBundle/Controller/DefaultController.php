<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Renz\ModelBundle\Entity\Booking;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
    	/**
    	 * Redirect user to booking page if RESERVATION MANAGER
    	 *
    	 * */
    	if ( $this->get('security.context')->isGranted('ROLE_RESERVATION') ) {
    		return $this->redirect($this->generateUrl('renz_admin_booking_index'));
    	}
    	
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('ModelBundle:Booking')->findAllPending();

        return array(
            'entities' => $entities,
        );
    }
}
