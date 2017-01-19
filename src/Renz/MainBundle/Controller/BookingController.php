<?php

namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

use Renz\ModelBundle\Entity\Room;
use Renz\ModelBundle\Entity\Booking;
use Renz\ModelBundle\Entity\Customer;

/**
 * Booking controller.
 *
 * @Route("/{_locale}/booking", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 */
class BookingController extends Controller
{
    /**
     * Booking form
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    	/*
    	 * if user came from reservation form
    	 * 
    	 * */
    	$session = $request->getSession();
    	if ( $session->get('reservation_roomid') ){
    		
    		$roomid = $session->get('reservation_roomid');
    		$checkin = $session->get('reservation_checkin');
    		$checkout = $session->get('reservation_checkout');
    		$guests = $session->get('reservation_guests');
    		$days = $session->get('reservation_totalnights');
    		
    		$submittedData = array(
    			'roomid'	=>$roomid,
    			'checkin'	=>$checkin,
    			'checkout'	=>$checkout,
    			'guests'	=>$guests,
    			'days'		=>$days,
    		);
    		
        	$em = $this->getDoctrine()->getManager();
        	
        	$countryEntities = $em->getRepository('ModelBundle:Country')->findAll();
        	$cardtypeEntities = $em->getRepository('ModelBundle:Cardtype')->findAll();
        	$cardmonthEntities = $em->getRepository('ModelBundle:Cardmonth')->findAll();
        	$cardyearEntities = $em->getRepository('ModelBundle:Cardyear')->findAll();
        	
        	$entity = $em->getRepository('ModelBundle:Room')->find($roomid);
        	if (!$entity) {
        		throw $this->createNotFoundException('Unable to find Room entity.');
        	}
        	
        	/*
        	 * If user logged in retrieve it's information to populate booking form with user data
        	 * 
        	 * */
        	if( $this->get('security.context')->isGranted('ROLE_USER') ){
        		$loggedinCustomer = $this->get('security.context')->getToken()->getUser();
        		$customerEntity = $em->getRepository('ModelBundle:Customer')->find($loggedinCustomer->getId());
        	}
        	
        	/*
        	 * Checking if reservation was closed for selected room
        	 * 
        	 * */

        	// 1 = Standard Rate, 
        	// 2 = Non Refundable Rate
        	$policyInClosure = 0;





        	///////////////////


        	$userCheckinDate = \DateTime::createFromFormat('Y-m-d', $checkin);
        	$userCheckoutDate = \DateTime::createFromFormat('Y-m-d', $checkout);

        	/*
			 * Getting all dates from user checkin to checkout (checkout-1)
			 * 
        	 */
        	$userSelectedDates = array();
			$uscid = $userCheckinDate;
			$uscod = $userCheckoutDate;

			while( $uscid < $uscod ){
				$userSelectedDates[] = $uscid->format('Y-m-d');
				$uscid->modify('+1 day')->format('Y-m-d');
			}

			/*
			echo "<br />";
			echo "user selected dates from checkin to checkout";
			echo "<pre>";
			var_dump($userSelectedDates);
			echo "</pre>";
			echo "<br />";
			*/
			/*************************************************/

			/*
			 * Check if any closure (e-g Standard Rate or Non Refundable Rate) was defined against user selected room
			 * If no closure was created for user selected Room booking will be considered open with (Standard Rate)
			 */
			if( $entity->getRoomclosure() ){

				//$extractedRoomClosureFromDates = array();
				//$extractedRoomClosureToDates = array();

				$individualRoomClosureDates = array();
				$individualRoomClosureDatesRates = array();

				/*
				 * Extracting individual closure against user selected Room
				 * 
				 */
				foreach ( $entity->getRoomclosure() as $closure ) {

					/*
					 * STANDARD
					 * NONREFUNDABLE
					 */
					$openRate = "";

					//determine closure closed/open rate
					if ( $closure->getIsAvailableStandard() ){
						//standard rate is closed
						$openRate = "NONREFUNDABLE";
					}else if ( $closure->getIsAvailableNonRefundable() ){
						//non refundable rate is closed
						$openRate = "STANDARD";
					}else{
						//no rate was closed but closure still exist for user selected room forward standard rate
						$openRate = "STANDARD";
					}

					/*
					 * Extract all room closure dates and construct an array of it ($individualRoomClosureDates) array.
					 * Also Extract and construct an array for available rate type for each date ($individualRoomClosureDatesRates) array.
					 * 
					 */
					$extClosureSDate = $closure->getClosefrom();
					$extClosureEDate = $closure->getCloseto();

					while( $extClosureSDate <= $extClosureEDate ){
						$individualRoomClosureDates[] = $extClosureSDate->format('Y-m-d');
						$individualRoomClosureDatesRates[] = $openRate;
						$extClosureSDate->modify('+1 day')->format('Y-m-d');
					}
					/*******************************************************/

					//$extractedRoomClosureFromDates[] = $closure->getClosefrom()->format('Y-m-d');
					//$extractedRoomClosureToDates[] = $closure->getCloseto()->format('Y-m-d');

				}//end: foreach

				//it will help determine how many room closures were found for user selected room
				#$roomClosureCounter = count($extractedRoomClosureFromDates);

				/*
				 * Below code will construct an array of user selected dates from checkin to checkout with rate types
				 * Array named "$userSelectedDatesWithOpenRateTypes" will have all user dates + rate types
				 */
				$userSelectedDatesWithOpenRateTypes = array();
				foreach ($userSelectedDates as $userDate) {
					//find user dates in "$individualRoomClosureDates" Array and return it's key to get rate applied from "$individualRoomClosureDatesRates" Array.
					$searchKey = array_search($userDate, $individualRoomClosureDates);
					if ( $searchKey ){
						$userSelectedDatesWithOpenRateTypes[] = array($userDate, $individualRoomClosureDatesRates[$searchKey]);
					}else{
						//if user selected check after or before dates defined in any closure for selected room type
						$userSelectedDatesWithOpenRateTypes[] = array($userDate, "STANDARD");
					}

				}
				/****************************************************/
				/*
				echo "<hr />";
				echo "<pre>";
				var_dump($userSelectedDatesWithOpenRateTypes);
				echo "</pre>";
				echo "<hr />";
				*/
				return array(
	        		'entity'      => $entity,
	        		'countries'	  => $countryEntities,
	        		'cardtypes'	  => $cardtypeEntities,
	        		'cardyear'	  => $cardyearEntities,
	        		'cardmonth'	  => $cardmonthEntities,
	        		'previousdata'=> $submittedData,
	        		'policy'	  => $policyInClosure,
	        		'customer'	  => @$customerEntity,
	        		'reservationDates' => $userSelectedDatesWithOpenRateTypes,
	        	);

			}else{

				/* ............ temperary redirect untill decided and checked ............
    			 * reservation closed
    			 * */
        		return $this->redirect($this->generateUrl('renz_main_booking_closed'));

			}//end: room closure availability check
        	
    	}else{
    		return $this->redirect($this->generateUrl('renz_main_page_index'));
    	}
    }
    
    /**
     * Booking form submitted
     *
     * @Route("/submit")
     * @Template()
     */
    public function submitAction(Request $request)
    {
    	if ($request->isMethod('POST')){
    		
	    	/*
	    	 * Saving booking
	    	 *
	    	 */
	    	$entity = new Booking();
	    	
	    	if( $this->get('security.context')->isGranted('ROLE_USER') ){
	    		$loggedinCustomer = $this->get('security.context')->getToken()->getUser();
	    	}
	    	
	    	$em = $this->getDoctrine()->getManager();
	    	
	    	/*
	    	 * getting instances
	    	 * 
	    	 * */
	    	$countryInstance = $em->getRepository('ModelBundle:Country')->findOneBy(array('id'=>$this->get('request')->request->get('country')));
	    	$cardtypeInstance = $em->getRepository('ModelBundle:Cardtype')->findOneBy(array('id'=>$this->get('request')->request->get('cardtype')));
	    	$expiryMonthInstance = $em->getRepository('ModelBundle:Cardmonth')->findOneBy(array('id'=>$this->get('request')->request->get('expirydate_month')));
	    	$expiryYearInstance = $em->getRepository('ModelBundle:Cardyear')->findOneBy(array('id'=>$this->get('request')->request->get('expirydate_year')));
	    	$roomInstance = $em->getRepository('ModelBundle:Room')->findOneBy(array('id'=>$this->get('request')->request->get('room')));
	    	$bookingstatusInstance = $em->getRepository('ModelBundle:Bookingstatus')->findOneBy(array('id'=>1));
	    	$bookingstatuscustomerInstance = $em->getRepository('ModelBundle:Bookingstatuscustomer')->findOneBy(array('id'=>1));
	    	
	    	/*
	    	 * Creating User User
	    	 * 
	    	 * */
	    	if( !$this->get('security.context')->isGranted('ROLE_USER') ){
	    		
	    		$newcustomer = new Customer();
	    		
	    		$newcustomer->setFirstname($this->get('request')->request->get('firstname'));
	    		$newcustomer->setLastname($this->get('request')->request->get('lastname'));
	    		$newcustomer->setUsername($this->get('request')->request->get('email'));
	    		$newcustomer->setEmail($this->get('request')->request->get('email'));
	    		$newcustomer->setAddress($this->get('request')->request->get('address'));
	    		$newcustomer->setCity($this->get('request')->request->get('city'));
	    		$newcustomer->setZip($this->get('request')->request->get('zipcode'));
	    		$newcustomer->setCountry($countryInstance);
	    		$newcustomer->setMobile($this->get('request')->request->get('mobile'));
	    		$newcustomer->setCardownername($this->get('request')->request->get('cardownername'));
	    		$newcustomer->setCardtype($cardtypeInstance);
	    		$newcustomer->setCardnumber($this->get('request')->request->get('cardnumber'));
	    		$newcustomer->setExpiryMonth($expiryMonthInstance);
	    		$newcustomer->setExpiryYear($expiryYearInstance);
	    		$newcustomer->setIsActive(1);
	    		
	    		$encoder = $this->container->get('security.encoder_factory')->getEncoder($newcustomer);
	    		$newcustomer->setPassword($encoder->encodePassword($this->get('request')->request->get('paswd'), $newcustomer->getSalt()));
	    		
	    		$em->persist($newcustomer);
	    		$em->flush();
	    		
	    		/*new created user instance*/
	    		$customerInstance = $em->getRepository('ModelBundle:Customer')->findOneBy(array('id'=>$newcustomer->getId()));
	    	}else{
	    		/*logged in user instance*/
	    		$customerInstance = $em->getRepository('ModelBundle:Customer')->findOneBy(array('id'=>$loggedinCustomer->getId()));
	    	}
	    	/*************************************************************************************************/
	    	
	    	$bookingReference = date("dmy")."-".rand(3,999);
	    	
	    	$entity->setGuests($this->get('request')->request->get('guests'));
	    	$entity->setDateCheckin(new \DateTime($this->get('request')->request->get('dateCheckin')));
	    	$entity->setDateCheckout(new \DateTime($this->get('request')->request->get('dateCheckout')));
	    	$entity->setTotalDays($this->get('request')->request->get('totalDays'));
	    	$entity->setSpecialRequests($this->get('request')->request->get('specialrequests'));
	    	$entity->setFirstname($this->get('request')->request->get('firstname'));
	    	$entity->setLastname($this->get('request')->request->get('lastname'));
	    	$entity->setEmail($this->get('request')->request->get('email'));
	    	$entity->setAddress($this->get('request')->request->get('address'));
	    	$entity->setCity($this->get('request')->request->get('city'));
	    	$entity->setZipcode($this->get('request')->request->get('zipcode'));
	    	
	    	$entity->setPricecategory($this->get('request')->request->get('pricecategory'));
	    	$entity->setTotalprice($this->get('request')->request->get('totalprice'));
	    	$entity->setBookingreference($bookingReference);
	    	
	    	$entity->setCountry($countryInstance);
	    	
	    	$entity->setMobile($this->get('request')->request->get('mobile'));
	    	
	    	$entity->setCardownername($this->get('request')->request->get('cardownername'));
	    	
	    	$entity->setCardtype($cardtypeInstance);
	    	
	    	$entity->setCardnumber($this->get('request')->request->get('cardnumber'));
	    	
	    	$entity->setExpiryMonth($expiryMonthInstance);
	    	
	    	$entity->setExpiryYear($expiryYearInstance);
	    	
	    	$entity->setCreatedAt(new \DateTime());
	    	
	    	$entity->setRoom($roomInstance);
	    	
	    	$entity->setBookingstatus($bookingstatusInstance);
	    	
	    	$entity->setCustomer($customerInstance);
	    	
	    	$entity->setBookingstatuscustomer($bookingstatuscustomerInstance);
	    	
	    	$em->persist($entity);
	    	$em->flush();
	    	/**************************************************************/
	    	
	    	/*
	    	 * Send New Reservation Notification to Reservation manager
	    	 * 
	    	 * */
	    	$notificationData = array(
	    		'name' => $this->get('request')->request->get('firstname')." ".$this->get('request')->request->get('lastname'),
	    		'reference' => $bookingReference,
	    		'booking_id' => $entity->getId(),
	    	);
	    	$message = \Swift_Message::newInstance()
	    	->setSubject('New Reservation Notification Ref: '.$bookingReference)
	    	->setFrom('noreply@renz.com.sa')
	    	->setTo('reservation@renz.com.sa')
	    	->setBcc(array(
	    		'kimmuzafars@gmail.com'=>'Muzafar Ali',
	    	))
	    	->setBody(
    			$this->renderView(
    				'MainBundle:Booking:sendReservationNotification.html.twig',
    				$notificationData
    			),
    			'text/html'
	    	);
	    	$this->get('mailer')->send($message);
	    	/******************************************************************************/
	    	
	    	/*
	    	 * Send New Reservation Notification to customer
	    	 *
	    	 * */
	    	 if( $this->get('security.context')->isGranted('ROLE_USER') ){ /* Get user email from session if logged in otherwise get it from submitted form */
	    		$customerEmail = $this->get('security.context')->getToken()->getUser()->getEmail();
	    	 }else{
	    		$customerEmail = $this->get('request')->request->get('email');
	    	 }
	    	
	    	$notificationData = array(
	    		'name' => $this->get('request')->request->get('firstname')." ".$this->get('request')->request->get('lastname'),
	    		'reference' => $bookingReference,
	    		'booking_id' => $entity->getId(),
	    	);
	    	$message = \Swift_Message::newInstance()
	    	->setSubject('Reservation Notification Ref: '.$bookingReference)
	    	->setFrom('noreply@renz.com.sa')
	    	->setTo($customerEmail)
	    	->setBcc(array(
	    		'kimmuzafars@gmail.com'=>'Muzafar Ali',
	    	))
	    	->setBody(
	    		$this->renderView(
	    			'MainBundle:Booking:sendReservationNotificationCustomer.html.twig',
	    			$notificationData
	    		),
	    		'text/html'
	    	);
	    	$this->get('mailer')->send($message);
	    	/******************************************************************************/
	    	
	    	/*
	    	 * Resetting all session variables which were set while reservation form was submitted..
	    	 * 
	    	 * */
	    	$session = $request->getSession();
	    	$session->remove('reservation_roomid');
	    	$session->remove('reservation_checkin');
	    	$session->remove('reservation_checkout');
	    	$session->remove('reservation_guests');
	    	$session->remove('reservation_totalnights');
	    	
	    	$this->get('session')->getFlashBag()->set('error', '<b>Reservation completed successfully..</b> We will acknowledge receipt of your reservation through email shortly..');
	    	return $this->redirect($this->generateUrl('renz_main_room_index'));
    	}
    }
    
    /**
     * Booking closed page
     *
     * @Route("/closed")
     * @Template()
     */
    public function closedAction()
    {
    	return array();
    }
    
    /**
     * Cancelling booking (while booking if user pressed cancel button his session will expire)
     *
     * @Route("/cancel-booking")
     * @Template()
     */
    public function cancelbookingAction(Request $request)
    {
    	/*
    	 * Resetting all session variables which were set while reservation form was submitted..
    	 *
    	 * */
    	$session = $request->getSession();
    	
    	if ( $session->get('reservation_roomid') ){
    		
	    	$session->remove('reservation_roomid');
	    	$session->remove('reservation_checkin');
	    	$session->remove('reservation_checkout');
	    	$session->remove('reservation_guests');
	    	$session->remove('reservation_totalnights');
	    	
	    	return $this->redirect($this->generateUrl('renz_main_room_index'));
    	}
    }
}