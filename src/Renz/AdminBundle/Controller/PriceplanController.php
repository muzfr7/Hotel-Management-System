<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Priceplan;
use Renz\AdminBundle\Form\PriceplanType;

/**
 * Priceplan controller.
 *
 * @Route("/priceplan")
 */
class PriceplanController extends Controller
{

    /**
     * Lists all Priceplan entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ModelBundle:Priceplan')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Priceplan entity.
     *
     * @Route("/")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity = new Priceplan();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('error', 'Added Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_priceplan_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Priceplan entity.
     *
     * @param Priceplan $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Priceplan $entity)
    {
        $form = $this->createForm(new PriceplanType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_priceplan_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Priceplan entity.
     *
     * @Route("/new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Priceplan();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Priceplan entity.
     *
     * @Route("/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Priceplan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Priceplan entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Priceplan entity.
     *
     * @Route("/{id}/edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Priceplan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Priceplan entity.');
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
    * Creates a form to edit a Priceplan entity.
    *
    * @param Priceplan $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Priceplan $entity)
    {
        $form = $this->createForm(new PriceplanType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_priceplan_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Priceplan entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Priceplan')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Priceplan entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_priceplan_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Priceplan entity.
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
            $entity = $em->getRepository('ModelBundle:Priceplan')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Priceplan entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_priceplan_index'));
    }

    /**
     * Creates a form to delete a Priceplan entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renz_admin_priceplan_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
            ->getForm()
        ;
    }
}
