<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Contact;

/**
 * Common controller.
 *
 * @Route("/common")
 */
class CommonController extends Controller
{   
    /**
     * Displaying number of new / unread messages in top / header
     *
     * @Route("/unreadmessagecounter")
     * @Method("GET")
     * @Template()
     */
    public function unreadmessagecounterAction(){
    	
    	$em = $this->getDoctrine()->getManager();
    	$totalUnreadMessages = $em->getRepository('ModelBundle:Contact')->countUnreadMessages();
    	
    	return array(
    		'unreadmessages' => $totalUnreadMessages,
    	);
    }
}
