<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Roompolicy;
use Renz\AdminBundle\Form\RoompolicyType;

/**
 * Roompolicy controller.
 *
 * @Route("/roompolicy")
 */
class RoompolicyController extends Controller
{

    /**
     * Lists all Roompolicy entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ModelBundle:Roompolicy')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Roompolicy entity.
     *
     * @Route("/")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity = new Roompolicy();
        $entity->setCreatedAt(new \DateTime());
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->set('error', 'Added Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_roompolicy_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Roompolicy entity.
     *
     * @param Roompolicy $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Roompolicy $entity)
    {
        $form = $this->createForm(new RoompolicyType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_roompolicy_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Roompolicy entity.
     *
     * @Route("/new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Roompolicy();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Roompolicy entity.
     *
     * @Route("/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Roompolicy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roompolicy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Roompolicy entity.
     *
     * @Route("/{id}/edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Roompolicy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roompolicy entity.');
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
    * Creates a form to edit a Roompolicy entity.
    *
    * @param Roompolicy $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Roompolicy $entity)
    {
        $form = $this->createForm(new RoompolicyType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_roompolicy_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Roompolicy entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Roompolicy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Roompolicy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_roompolicy_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Roompolicy entity.
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
            $entity = $em->getRepository('ModelBundle:Roompolicy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Roompolicy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }
        
        $this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_roompolicy_index'));
    }

    /**
     * Creates a form to delete a Roompolicy entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renz_admin_roompolicy_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
            ->getForm()
        ;
    }
}
