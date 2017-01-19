<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Roomavailabilitydate;
use Renz\AdminBundle\Form\RoomavailabilitydateType;

/**
 * Roomavailabilitydate controller.
 *
 * @Route("/roomavailabilitydate")
 */
class RoomavailabilitydateController extends Controller
{
    /**
     * Lists all Roomavailabilitydate entities.
     *
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    	/* Get all rooms */
        $em = $this->getDoctrine()->getManager();
        $rooms = $em->getRepository('ModelBundle:Room')->findAll();
		
        /* submitted dates info */
        if($this->get('request')->request->get('fromdate')){
	        $fromdate = $this->get('request')->request->get('fromdate');
	        $todate = $this->get('request')->request->get('todate');
	        $dates = $this->getAllDatesBetweenTwoDates($fromdate, $todate);
        }else{
        	$dates=array();
        }
        
        /************************** submitted rooms availability ***********************/
        $submittedData = $request->request->all();
        
        $submittedDataKeys = array_keys($submittedData); //getting all array keys
        unset($submittedDataKeys[count($submittedDataKeys)-1]); //removing btn from submitted data
        
        $datesAndRooms = array(); // to create new aaray ............test for now..
        
        foreach ($submittedDataKeys as $submittedDataKey){
        	
        	$submittedDataValue = $this->get('request')->request->get($submittedDataKey); //getting value using key
        	
        	$submittedDataKeyArray = explode("|", $submittedDataKey); //getting "Room id" and "date" from submitted data keys
        	$submittedDataKeyRoom = $submittedDataKeyArray[0];
        	$submittedDataKeyDate = $submittedDataKeyArray[1];
        	
        	/*
        	$entityRoomAvailbility = new Roomavailabilitydate();
        	$entityRoomAvailbility->setDate(new \DateTime($submittedDataKeyDate));
        	$em->persist($entityRoomAvailbility);
        	$em->flush();
        	*/
        	
        	if( array_key_exists($submittedDataKeyDate, $datesAndRooms) ){
        		$datesAndRooms[$submittedDataKeyDate] = array($submittedDataKeyRoom=>$submittedDataValue);
        	}else{
        		$datesAndRooms = array($submittedDataKeyDate);
        	}
        	
        	echo $submittedDataKeyDate."=>".$submittedDataKeyRoom."=>".$submittedDataValue."<br />";
        }
        /*******************************************************************************/
        
        echo "<pre>";
        print_r($datesAndRooms);
        echo "</pre>";
        
        return array(
            'rooms' => $rooms,
        	'dates' => $dates,
        );
    }

    /**
     * Creates a form to create a Roomavailabilitydate entity.
     *
     * @param Roomavailabilitydate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Roomavailabilitydate $entity)
    {
        $form = $this->createForm(new RoomavailabilitydateType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_roomavailabilitydate_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Roomavailabilitydate entity.
     *
     * @Route("/new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Roomavailabilitydate();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Roomavailabilitydate entity.
     *
     * @Route("/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Roomavailabilitydate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomavailabilitydate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Roomavailabilitydate entity.
     *
     * @Route("/{id}/edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Roomavailabilitydate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomavailabilitydate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Roomavailabilitydate entity.
    *
    * @param Roomavailabilitydate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Roomavailabilitydate $entity)
    {
        $form = $this->createForm(new RoomavailabilitydateType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_roomavailabilitydate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Roomavailabilitydate entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Roomavailabilitydate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roomavailabilitydate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_roomavailabilitydate_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Roomavailabilitydate entity.
     *
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ModelBundle:Roomavailabilitydate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Roomavailabilitydate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_roomavailabilitydate_index'));
    }

    /**
     * Creates a form to delete a Roomavailabilitydate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renz_admin_roomavailabilitydate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
            ->getForm()
        ;
    }
    
    # Get all dates between two dates using php code:
    function getAllDatesBetweenTwoDates($strDateFrom,$strDateTo)
    {
    	$aryRange=array();
    
    	$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    	$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));
    
    	if ($iDateTo>=$iDateFrom)
    	{
    		array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
    		while ($iDateFrom<$iDateTo)
    		{
    			$iDateFrom+=86400; // add 24 hours
    			array_push($aryRange,date('Y-m-d',$iDateFrom));
    		}
    	}
    	return $aryRange;
    }
    
}
