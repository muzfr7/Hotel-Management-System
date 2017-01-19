<?php

namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Room;
use Symfony\Component\HttpFoundation\Request;

/**
 * Room controller.
 *
 * @Route("/{_locale}/room", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 */
class RoomController extends Controller
{

    /**
     * Lists all Room entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ModelBundle:Room')->findAllActive();
        
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Room entity.
     *
     * @Route("/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Room')->find($id);
        
        $hotelPolicyEntities = $em->getRepository('ModelBundle:Hotelpolicy')->findAll();
        $hotelFacilityEntities = $em->getRepository('ModelBundle:Hotelfacility')->findAll();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }
		
        /* echo "<pre>";
        if( $entity->getRoomclosure()[0] ){
	        foreach ($entity->getRoomclosure() as $rrr){
	        	var_dump($rrr->getId());
	        }
        }else{
        	echo "-------------------------<br /><br />-----------------===================no";
        }
        echo "</pre>"; */
        
        return array(
            'entity'      => $entity,
        	'hotelfacilities' => $hotelFacilityEntities,
        	'hotelpolicies' => $hotelPolicyEntities,
        );
    }
    
    /**
     * Finds and displays a Room conditions.
     *
     * @Route("/room-booking-policy/{id}")
     * @Method("GET")
     * @Template()
     */
    public function termsconditionsAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    
    	$entity = $em->getRepository('ModelBundle:Roompolicy')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Room Policy entity.');
    	}
    
    	return array(
    		'entity'      => $entity,
    	);
    }
    
    /**
     * Search available rooms.
     *
     * @Route("/search/")
     * @Template()
     */
    public function searchroomsAction(Request $request)
    {
    	$queryParams 	= $this->get('request')->query->all();
    	$searchData = array(
	    	'dateCheckin' 	=> date('Y-m-d', strtotime($queryParams['checkin'])),
	    	'dateCheckout' 	=> date('Y-m-d', strtotime($queryParams['checkout'])),
	    	'guests' 		=> $queryParams['guests'],
    	);
    	
    	$em = $this->getDoctrine()->getManager();
    	$availableRooms = $em->getRepository('ModelBundle:Bulkavailable')->findAvailableRooms();
    	
    	if(!$availableRooms) {
    		throw $this->createNotFoundException('Unable to find Bulk Available Entity');
    	}
    	
    	return array(
    		'availableRooms' => $availableRooms,
    		'searchData'	 => $searchData,
    	);
    }
    
    /**
     * Check room if available.
     *
     * @Route("/check-if-available/")
     * @Template()
     */
    public function checkifavailableAction(Request $request)
    {
    	$queryParams 	= $this->get('request')->query->all();
    	
    	$roomid			= $queryParams['roomid'];
    	$dateCheckin 	= date('Y-m-d', strtotime($queryParams['checkin']));
    	$dateCheckout 	= date('Y-m-d', strtotime($queryParams['checkout']));
    	$guests			= $queryParams['guests'];
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$roomInstance = $em->getRepository('ModelBundle:Room')->findOneBy(array('id'=>$roomid)); /* getting room instance to use in bulkavailable*/
    	$bulkAvailable = $em->getRepository('ModelBundle:Bulkavailable')->findOneBy(array('room'=>$roomInstance));
    	
    	/*
    	 * Check if Room found in bulk available
    	 * 
    	 * */
    	if( $bulkAvailable ){
    		/*
    		 * Check Room availability
    		 * 
    		 * */
    		if( 
    			new \DateTime($dateCheckin) >= $bulkAvailable->getFromdate()
    				AND 
    			new \DateTime($dateCheckout) <= $bulkAvailable->getTodate()
    		){
    			/*
    			 * Check availability in each day
    			 * 
    			 * */
    			$isAvailable = 0; /* 1=if this room avialable for booking in specified date range, 0=if room not available for booking in specified date range*/
    			$bulkAvailableInDays = $bulkAvailable->getBulkavailableindays();
    			foreach ($bulkAvailableInDays as $inDay){
    				/*
    				 * Getting availability dates within checkin and checkout range to check qty on each date/day
    				 * 
    				 * */
    				if( 
		    			$inDay->getTodate() >= new \DateTime($dateCheckin) 
		    				AND 
		    			$inDay->getTodate()<= new \DateTime($dateCheckout)
		    		){
    					/* echo $inDay->getTodate()->format('Y-m-d')." - ".$inDay->getQty()."<br />"; */
    					if($inDay->getQty() > 0){
    						$isAvailable=1;
    					}else{
    						$isAvailable=0;
    					}
    				}
    			}/*end for*/
    			
    			/*
    			 * If isAvailable=1, Room is available for booking in specified date range 
    			 * 
    			 * */
    			if( $isAvailable==1 ){
    				
    				/*
    				 * Setting up sessions for booking/reservation page and redirect to that page
    				 * 
    				 * */
    				$session = $request->getSession();
					$session->set('reservation_roomid', $roomid);
					$session->set('reservation_checkin', $dateCheckin);
					$session->set('reservation_checkout', $dateCheckout);
					$session->set('reservation_guests', $guests);
					$session->set('reservation_totalnights', floor((abs(strtotime($dateCheckin)-strtotime($dateCheckout)))/(60*60*24)));
					
					return $this->redirect($this->generateUrl('renz_main_booking_index'));
    				
    			}else{
    				/*
    				 * Not available
    				* */
    				return $this->redirect($this->generateUrl('renz_main_booking_closed'));
    			}
    			
    		}else{
    			/*
    			 * Not available
    			 * */
    			return $this->redirect($this->generateUrl('renz_main_booking_closed'));
    		}
    	}
    	
    	
    	exit;
    }
    
    
    /**
     * For Ajax Call to display Capacity of selected room at home page reservation.
     * 
     * Returns Capacity of room
     *
     * @Route("/get-capacity/{id}")
     * @Method("GET")
     * @Template()
     */
    public function getcapacityAction($id)
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$entity = $em->getRepository('ModelBundle:Room')->find($id);
    	
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Room entity.');
    	}
    	
    	$options = array();
    	
    	for($i=1; $i<=$entity->getCapacity(); $i++){
    		$options[] = "<option value='".$i."'>".$i."</option>";
    	}
    	
    	echo implode('', $options);
    	exit;
    }
    
}