<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Contact;

/**
 * Contact controller.
 *
 * @Route("/contact")
 */
class ContactController extends Controller
{
    /**
     * Lists all Contact entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ModelBundle:Contact')->findAll();
		
        /* echo "<pre>";
        var_dump($entities);
        exit; */
        
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Contact entity.
     *
     * @Route("/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Contact')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contact entity.');
        }
        
        /*
         * Marking Message as read
         */
        $this->getDoctrine()->getRepository('ModelBundle:Contact')->createQueryBuilder('c')
        ->update()
        ->set('c.isread', 1)
        ->where('c.id='.$id)
        ->getQuery()->getResult();
        /***********************************************************************************/
		
        $deleteForm = $this->createDeleteForm($id);
        
        return array(
            'entity'      => $entity,
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
    		$entity = $em->getRepository('ModelBundle:Contact')->find($id);
    
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find Contact entity.');
    		}
    
    		$em->remove($entity);
    		$em->flush();
    	}
    
    	$this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
    	return $this->redirect($this->generateUrl('renz_admin_contact_index'));
    }
    
    /**
     * Creates a form to delete a Contact entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
    	return $this->createFormBuilder()
    	->setAction($this->generateUrl('renz_admin_contact_delete', array('id' => $id)))
    	->setMethod('DELETE')
    	->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
    	->getForm()
    	;
    }
}
