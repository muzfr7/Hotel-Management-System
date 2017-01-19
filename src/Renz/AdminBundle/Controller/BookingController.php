<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Renz\ModelBundle\Entity\Booking;
use Renz\AdminBundle\Form\BookingType;

/**
 * Booking controller.
 *
 * @Route("/booking")
 */
class BookingController extends Controller
{

    /**
     * Lists all Booking entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('ModelBundle:Booking')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    
    /**
     * Creates a new Booking entity.
     *
     * @Route("/")
     * @Method("POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $entity = new Booking();
        $entity->setCreatedat(new \DateTime());
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $entity->setBookingreference(date("dmy")."-".rand(3,999));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->set('error', 'Added Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_booking_index'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Booking entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Booking $entity)
    {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_booking_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Booking entity.
     *
     * @Route("/new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Booking();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Booking entity.
     *
     * @Route("/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('ModelBundle:Booking')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
        
        /*
         * Policy
         * 
         * */
        $entityPolicy = $em->getRepository('ModelBundle:Roompolicy')->find($entity->getPricecategory());
        
        if (!$entityPolicy) {
            //throw $this->createNotFoundException('Unable to find Room Policy entity.');
            $entityPolicy = null;
        }
        
        return array(
            'entity'       => $entity,
            'entityPolicy' => $entityPolicy,
            'delete_form'  => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Booking entity.
     *
     * @Route("/{id}/edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
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
    * Creates a form to edit a Booking entity.
    *
    * @param Booking $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Booking $entity)
    {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('renz_admin_booking_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Booking entity.
     *
     * @Route("/{id}")
     * @Method("PUT")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ModelBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }
        
        /*
         * Policy
        *
        * */
        $entityPolicy = $em->getRepository('ModelBundle:Roompolicy')->find($entity->getPricecategory());
        
        if (!$entityPolicy) {
            throw $this->createNotFoundException('Unable to find Room Policy entity.');
        }
        
        /*
         * Update booking status
         * 
         */
        //echo $request->request->get('renz_modelbundle_booking')['bookingstatus'];
        //////////////////////////
        //echo "<pre>";
        //var_dump($request->request->get('renz_modelbundle_booking'));
        //exit;
        $dataForEmailsArr = $request->request->get('renz_modelbundle_booking');
        $dataForEmailsArr['totalprice'] = $entity->getTotalprice();
        $dataForEmailsArr['bookingreference'] = $entity->getBookingreference();
        $dataForEmailsArr['room'] = $entity->getRoom();
        $dataForEmailsArr['createdAt'] = $entity->getCreatedAt();
        $dataForEmailsArr['country'] = $entity->getCountry();
        $dataForEmailsArr['cardtype'] = $entity->getCardtype();
        $dataForEmailsArr['policy'] = $entityPolicy->getDetail();
        
        if( $dataForEmailsArr['bookingstatus']==2 ){ //Check if reserved
            $message = \Swift_Message::newInstance()
                ->setSubject('Your Reservation at Renz Hotel')
                ->setFrom('noreply@renz.com.sa')
                ->setTo($dataForEmailsArr['email'])
                ->setBody(
                    $this->renderView(
                        'AdminBundle:Booking:sendReservedEmail.html.twig',
                        $dataForEmailsArr
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }
        
        if( $dataForEmailsArr['bookingstatus']==3 ){ //Check if cancelled
            $message = \Swift_Message::newInstance()
            ->setSubject('Your Reservation at Renz Hotel')
            ->setFrom('noreply@renz.com.sa')
            ->setTo($dataForEmailsArr['email'])
            ->setBody(
                $this->renderView(
                    'AdminBundle:Booking:sendCancelledEmail.html.twig',
                    $dataForEmailsArr
                ),
                'text/html'
            );
            $this->get('mailer')->send($message);
        }
        /**************************************************************************/
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {
            $em->flush();

            $this->get('session')->getFlashBag()->set('error', 'Updated Successfully..');
            return $this->redirect($this->generateUrl('renz_admin_booking_index'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Booking entity.
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
            $entity = $em->getRepository('ModelBundle:Booking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Booking entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        $this->get('session')->getFlashBag()->set('error', 'Deleted Successfully..');
        return $this->redirect($this->generateUrl('renz_admin_booking_index'));
    }

    /**
     * Creates a form to delete a Booking entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('renz_admin_booking_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete', 'attr'=>array('class'=>'btn btn-special btn-red', 'style'=>'width:100%;')))
            ->getForm()
        ;
    }
}