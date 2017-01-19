<?php
namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Room;
use Renz\AdminBundle\Form\RoomType;

/**
 * Room controller.
 * 
 * @Route("/room")
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

        $entities = $em->getRepository('ModelBundle:Room')->findAll();
        
        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Creates a new Room entity.
     *
     * @Route("/")
     * @Method("POST")
     */
    public function createAction(Request $request)
    {
        $entity = new Room();
        $entity->setCreatedat(new \DateTime());
        $entity->setIsAvailable(0);
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
        	
        	$newSlug = str_replace(' ', '-', strtolower(trim($form['title']->getData())));
        	$entity->setSlug($newSlug);
        	
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
			
            $this->get('session')->getFlashBag()->set('error', 'Added Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_room_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Room entity.
     *
     * @param Room $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Room $entity)
    {
        $form = $this->createForm(new RoomType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_room_create'),
            'method' => 'POST',
        	'attr' => array(
        		'id' => 'renz_room_create_form',
        	),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Room entity.
     *
     * @Route("/new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Room();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
		
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Room entity.
     *
     * @Route("/{id}/edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
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
    * Creates a form to edit a Room entity.
    *
    * @param Room $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Room $entity)
    {
        $form = $this->createForm(new RoomType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_room_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        	'attr'	 => array(
        		'novalidate'=>'novalidate',
        	),
        ));

        return $form;
    }
    /**
     * Edits an existing Room entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Room')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Room entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
        	
        	$newSlug = str_replace(' ', '-', strtolower(trim($editForm['title']->getData())));
        	$entity->setSlug($newSlug);
        	
            $em->flush();
			
            $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_room_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Room entity.
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
            $entity = $em->getRepository('ModelBundle:Room')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Room entity.');
            }

            $em->remove($entity);
            $em->flush();
        }
		
        $this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_room_index'));
    }

    /**
     * Creates a form to delete a Room entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renz_admin_room_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
            ->getForm()
        ;
    }
    
    /**
     * Close or open booking.
     *
     * @Route("/close-or-open-booking/{id}/{toggle}")
     * @Method("GET")
     * @Template()
     */
    public function togglebookingAction($id, $toggle)
    {
        $this->getDoctrine()->getRepository('ModelBundle:Room')->createQueryBuilder('r')
	        ->update()
	        ->set('r.isAvailable', $toggle)
	        ->where('r.id='.$id)
	        ->getQuery()->getResult();
        
        $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_room_index'));
    }
}
