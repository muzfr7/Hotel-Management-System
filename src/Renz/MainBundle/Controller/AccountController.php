<?php

namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Account controller.
 * @return Response
 * @Route("/{_locale}/account", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 */
class AccountController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    	/**
    	 * Redirect user back to login, if NOT LOGGED IN
    	 *
    	 * */
    	if ( !$this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_security_login'));
    	}
    	
    	/*
    	 * If user being logged in from booking page, redirect him back to booking page to complete..
    	 * 
    	 * */
    	$session = $request->getSession();
    	if ( $session->get('reservation_roomid') ){
    		return $this->redirect($this->generateUrl('renz_main_booking_index'));
    	}
    	
    	return array();
    }
    
    /**
     * @Route("/reservations")
     * @Template()
     */
    public function reservationsAction()
    {
    	/**
    	 * Redirect user back to login, if NOT LOGGED IN
    	 *
    	 * */
    	if ( !$this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_security_login'));
    	}
    	
    	$em = $this->getDoctrine()->getManager();
    	$loggedinCustomer = $this->get('security.context')->getToken()->getUser();
    	$customerEntity = $em->getRepository('ModelBundle:Customer')->find($loggedinCustomer->getId());
    	
    	return array(
    		'customer' => $customerEntity,
    	);
    }
    
    /**
     * @Route("/reservation-update")
     * @Template()
     */
    public function reservationupdateAction(Request $request)
    {
    	/**
    	 * Redirect user back to login, if NOT LOGGED IN
    	 *
    	 * */
    	if ( !$this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_security_login'));
    	}
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$countryEntities = $em->getRepository('ModelBundle:Country')->findAll();
    	$cardtypeEntities = $em->getRepository('ModelBundle:Cardtype')->findAll();
    	$cardmonthEntities = $em->getRepository('ModelBundle:Cardmonth')->findAll();
    	$cardyearEntities = $em->getRepository('ModelBundle:Cardyear')->findAll();
    	$bookingstatuscustomerEntities = $em->getRepository('ModelBundle:Bookingstatuscustomer')->findAll();
    	
    	$loggedinCustomer = $this->get('security.context')->getToken()->getUser();
    	$customerEntity = $em->getRepository('ModelBundle:Customer')->find($loggedinCustomer->getId());
    	
    	$param = $request->query->all(); //getting url params
    	$bookingEntity = $em->getRepository('ModelBundle:Booking')->find($param['id']);
    	
    	/*
    	 * Saving Submitted Data
    	 *
    	 * */
    	if ($request->isMethod('POST')){
    	
    		/* Getting Instances for joined tables */
    		$countryInstance = $em->getRepository('ModelBundle:Country')->findOneBy(array('id'=>$this->get('request')->request->get('country')));
    		$cardtypeInstance = $em->getRepository('ModelBundle:Cardtype')->findOneBy(array('id'=>$this->get('request')->request->get('cardtype')));
    		$expiryMonthInstance = $em->getRepository('ModelBundle:Cardmonth')->findOneBy(array('id'=>$this->get('request')->request->get('expiryMonth')));
    		$expiryYearInstance = $em->getRepository('ModelBundle:Cardyear')->findOneBy(array('id'=>$this->get('request')->request->get('expiryYear')));
    		$bookingstatuscustomerInstance = $em->getRepository('ModelBundle:Bookingstatuscustomer')->findOneBy(array('id'=>$this->get('request')->request->get('bookingstatuscustomer')));
    	
    		$bookingEntity->setFirstname($this->get('request')->request->get('firstname'));
    		$bookingEntity->setLastname($this->get('request')->request->get('lastname'));
    		
    		$bookingEntity->setGuests($this->get('request')->request->get('guests'));
    		$bookingEntity->setSpecialRequests($this->get('request')->request->get('specialrequests'));
    		$bookingEntity->setBookingstatuscustomer($bookingstatuscustomerInstance);
    		
    		$bookingEntity->setAddress($this->get('request')->request->get('address'));
    		$bookingEntity->setCity($this->get('request')->request->get('city'));
    		$bookingEntity->setZipcode($this->get('request')->request->get('zip'));
    		$bookingEntity->setCountry($countryInstance);
    		$bookingEntity->setMobile($this->get('request')->request->get('mobile'));
    	
    		$bookingEntity->setCardownername($this->get('request')->request->get('cardownername'));
    		$bookingEntity->setCardtype($cardtypeInstance);
    		$bookingEntity->setCardnumber($this->get('request')->request->get('cardnumber'));
    		$bookingEntity->setExpiryMonth($expiryMonthInstance);
    		$bookingEntity->setExpiryYear($expiryYearInstance);
    	
    		$em->persist($bookingEntity);
    		$em->flush();
    	
    		$this->get('session')->getFlashBag()->set('success', 'Your Booking Updated..');
    		return $this->redirect($this->generateUrl('renz_main_account_index'));
    	
    	} /* Saving Submitted Data */
    	
    	return array(
    		'countries'	  => $countryEntities,
    		'cardtypes'	  => $cardtypeEntities,
    		'cardyear'	  => $cardyearEntities,
    		'cardmonth'	  => $cardmonthEntities,
    		'customer'	=> $customerEntity,
    		'booking' => $bookingEntity,
    		'bookingstatuscustomer' => $bookingstatuscustomerEntities,
    	);
    }
    
    /**
     * @Route("/profile")
     * @Template()
     */
    public function profileAction(Request $request)
    {
    	/**
    	 * Redirect user back to login, if NOT LOGGED IN
    	 *
    	 * */
    	if ( !$this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_security_login'));
    	}
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$countryEntities = $em->getRepository('ModelBundle:Country')->findAll();
    	$cardtypeEntities = $em->getRepository('ModelBundle:Cardtype')->findAll();
    	$cardmonthEntities = $em->getRepository('ModelBundle:Cardmonth')->findAll();
    	$cardyearEntities = $em->getRepository('ModelBundle:Cardyear')->findAll();
    	
    	$loggedinCustomer = $this->get('security.context')->getToken()->getUser();
    	$customerEntity = $em->getRepository('ModelBundle:Customer')->find($loggedinCustomer->getId());
    	
    	/*
    	 * Saving Submitted Data
    	 * 
    	 * */
    	if ($request->isMethod('POST')){
    		
    		/* Getting Instances for joined tables */
    		$countryInstance = $em->getRepository('ModelBundle:Country')->findOneBy(array('id'=>$this->get('request')->request->get('country')));
    		$cardtypeInstance = $em->getRepository('ModelBundle:Cardtype')->findOneBy(array('id'=>$this->get('request')->request->get('cardtype')));
    		$expiryMonthInstance = $em->getRepository('ModelBundle:Cardmonth')->findOneBy(array('id'=>$this->get('request')->request->get('expiryMonth')));
    		$expiryYearInstance = $em->getRepository('ModelBundle:Cardyear')->findOneBy(array('id'=>$this->get('request')->request->get('expiryYear')));
    		
    		$customerEntity->setFirstname($this->get('request')->request->get('firstname'));
    		$customerEntity->setLastname($this->get('request')->request->get('lastname'));
    		
    		$customerEntity->setAddress($this->get('request')->request->get('address'));
    		$customerEntity->setCity($this->get('request')->request->get('city'));
    		$customerEntity->setZip($this->get('request')->request->get('zip'));
    		$customerEntity->setCountry($countryInstance);
    		$customerEntity->setMobile($this->get('request')->request->get('mobile'));
    		
    		$customerEntity->setCardownername($this->get('request')->request->get('cardownername'));
    		$customerEntity->setCardtype($cardtypeInstance);
    		$customerEntity->setCardnumber($this->get('request')->request->get('cardnumber'));
    		$customerEntity->setExpiryMonth($expiryMonthInstance);
    		$customerEntity->setExpiryYear($expiryYearInstance);
    		
    		$em->persist($customerEntity);
    		$em->flush();
    		
    		$this->get('session')->getFlashBag()->set('success', 'Your Profile detail Updated..');
    		return $this->redirect($this->generateUrl('renz_main_account_index'));
    		
    	} /* Saving Submitted Data */
    	
    	return array(
    		'countries'	  => $countryEntities,
    		'cardtypes'	  => $cardtypeEntities,
    		'cardyear'	  => $cardyearEntities,
    		'cardmonth'	  => $cardmonthEntities,
    		
    		'customer'	  => $customerEntity,
    	);
    }
    
    /**
     * @Route("/change-password")
     * @Template()
     */
    public function changepasswordAction(Request $request)
    {
    	/**
    	 * Redirect user back to login, if NOT LOGGED IN
    	 *
    	 * */
    	if ( !$this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_security_login'));
    	}
    	
    	if ($request->isMethod('POST')){
    		
    		$password0 = $this->get('request')->request->get('existing-password');
    		$password1 = $this->get('request')->request->get('new-password');
    		$password2 = $this->get('request')->request->get('confirm-new-password');
    		
    		/*
    		 * Required fields empty check
    		 * 
    		 * */
    		if ( empty($password0) AND empty($password1) AND empty($password2) ){
    			$this->get('session')->getFlashBag()->set('error', 'Required fields left blank!');
    			return $this->redirect($this->generateUrl('renz_main_account_changepassword'));
    		}else{
    		
	    		$loggedinCustomer = $this->get('security.context')->getToken()->getUser();
	    		
	    		$em = $this->getDoctrine()->getManager();
	    		$entity = $em->getRepository('ModelBundle:Customer')->find($loggedinCustomer->getId());
	    		if (!$entity) {
	    			throw $this->createNotFoundException('Unable to find Customer entity.');
	    		}
	    		
	    		$encoder = $this->container->get('security.encoder_factory')->getEncoder($entity);
	    		
	    		/*
	    		 * Checking if existing password does match..
	    		 * 
	    		 * */
	    		if ( $encoder->encodePassword($password0, $entity->getSalt()) == $entity->getPassword() ){
					
	    			/*
	    			 * Check if both new passwords match if existing password ok
	    			 * 
	    			 * */
		    		if ($password1==$password2){
		    			
		    			$entity->setPassword($encoder->encodePassword($password1, $entity->getSalt()));
		    			
		    			/*
		    			 * Sending password changged email
		    			 * 
		    			 * */
		    			$message = \Swift_Message::newInstance()
		    			->setSubject(date('d-m-Y').' - Your Password Changed!')
		    			->setFrom('noreply@renz.com.sa')
		    			->setTo(array(
		    				$entity->getEmail() => $entity->getFirstname(),
		    			))
		    			->setBcc(array(
		    				'kimmuzafars@gmail.com'=>'Muzafar Ali',
		    			))
		    			->setBody(
	    					$this->renderView(
	    						'MainBundle:emails:password-changed.html.twig',
	    						array(
	    							'name' => $entity->getFirstname().' '.$entity->getLastname(),
	    							'date' => date('d-m-Y H:i:s')
	    						)
	    					),
	    					'text/html'
		    			);
		    			$this->get('mailer')->send($message);
		    			/***********************************************************/
		    			
		    			$em->flush();
		    			 
		    			$this->get('session')->getFlashBag()->set('success', 'Password changed successfully..');
		    			return $this->redirect($this->generateUrl('renz_main_account_changepassword'));
		    		}else{
		    			$this->get('session')->getFlashBag()->set('error', 'New Password and Confirm New Password does\'t match!');
		    			return $this->redirect($this->generateUrl('renz_main_account_changepassword'));
		    		}
	    		}else{
	    			$this->get('session')->getFlashBag()->set('error', 'Invalid Existing Password!');
	    			return $this->redirect($this->generateUrl('renz_main_account_changepassword'));
	    		}
	    		
    		} /* end empty check */
    	}
    	
    	return array();
    }
}