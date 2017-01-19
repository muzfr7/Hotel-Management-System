<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Bulkavailable;
use Renz\AdminBundle\Form\BulkavailableType;
use Renz\ModelBundle\Entity\Bulkavailableindays;

/**
 * Bulkavailable controller.
 *
 * @Route("/bulkavailable")
 */
class BulkavailableController extends Controller
{
    /**
     * Lists all Bulkavailable entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {	
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ModelBundle:Bulkavailable')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bulkavailable entity.
     *
     * @Route("/")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity = new Bulkavailable();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
        	
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
			
           /*
            * Setting per day quantity for Room
            * 
            * */
            $fromdate = $form->get('fromdate')->getData();
            $todate = $form->get('todate')->getData();
            $dates = new \DatePeriod( $fromdate, new \DateInterval('P1D'), $todate->modify('+1 day') );/*adding one day more as it's not printing dates till last date*/
             
            foreach ($dates as $date){
            	$bulkavailableindaysEntity = new Bulkavailableindays();
            
            	$bulkavailableindaysEntity->setTodate($date);
            	$bulkavailableindaysEntity->setQty($form->get('qty')->getData());
            	$bulkavailableindaysEntity->setBulkavailable($entity);
            
            	$em->persist($bulkavailableindaysEntity);
            	$em->flush();
            }
            /*******************************************************************************************/
            
            $this->get('session')->getFlashBag()->set('error', 'Added Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_bulkavailable_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bulkavailable entity.
     *
     * @param Bulkavailable $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bulkavailable $entity)
    {
        $form = $this->createForm(new BulkavailableType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_bulkavailable_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Bulkavailable entity.
     *
     * @Route("/new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bulkavailable();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bulkavailable entity.
     *
     * @Route("/{id}/show")
     * @Template()
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Bulkavailable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bulkavailable entity.');
        }
        
       /*
        * Per day quantities form submitted
        *
        * */
        if ($request->getMethod() == 'POST') {
        	$submittedData = $request->request->all();
        	for ($counter=0; $counter<count($submittedData['dates']); $counter++){
        		$bulkavailabilityindaysEntity = $em->getRepository('ModelBundle:Bulkavailableindays')->findBy(array('todate'=>new \DateTime($submittedData['dates'][$counter])));
        		$bulkavailabilityindaysEntity[0]->setQty($submittedData['quantities'][$counter]);
        		$em->flush();
        	}
        	$this->get('session')->getFlashBag()->set('error', 'Availability Updated Successfully..');
        	return $this->redirect($this->generateUrl('renz_admin_bulkavailable_show', array('id' => $id)));
        }
        /*****************************************************************************************************/
        
        $deleteForm = $this->createDeleteForm($id);
         
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bulkavailable entity.
     *
     * @Route("/{id}/edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Bulkavailable')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bulkavailable entity.');
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
    * Creates a form to edit a Bulkavailable entity.
    *
    * @param Bulkavailable $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bulkavailable $entity)
    {
        $form = $this->createForm(new BulkavailableType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_bulkavailable_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    
    /**
     * Edits an existing Bulkavailable entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Bulkavailable')->find($id);
		
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bulkavailable entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
			
           /*
            * Deleting existing records against current entity from bulkavailableindays table
            * 
            * */
            foreach ($entity->getBulkavailableindays() as $day){
            	$em->remove($day);
            	$em->flush();
            }
            /**********************************************************************/
            
           /*
            * Setting per day quantity for Room
            *
            * */
            $fromdate = $editForm->get('fromdate')->getData();
            $todate = $editForm->get('todate')->getData();
            
            /*adding one day more as it's not printing dates till last date*/
            $dates = new \DatePeriod( $fromdate, new \DateInterval('P1D'), $todate->modify('+1 day') );
             
            foreach ($dates as $date){
            	$bulkavailableindaysEntity = new Bulkavailableindays();
            
            	$bulkavailableindaysEntity->setTodate($date);
            	$bulkavailableindaysEntity->setQty($editForm->get('qty')->getData());
            	$bulkavailableindaysEntity->setBulkavailable($entity);
            
            	$em->persist($bulkavailableindaysEntity);
            	$em->flush();
            }
            /*******************************************************************************************/
            
            $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_bulkavailable_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    
    /**
     * Deletes a Bulkavailable entity.
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
            $entity = $em->getRepository('ModelBundle:Bulkavailable')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bulkavailable entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_bulkavailable_index'));
    }

    /**
     * Creates a form to delete a Bulkavailable entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renz_admin_bulkavailable_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
            ->getForm()
        ;
    }
}
