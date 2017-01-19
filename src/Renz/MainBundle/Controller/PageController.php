<?php
namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Renz\ModelBundle\Entity\Contact;
use Renz\ModelBundle\Entity\Newsletter;

/**
 * @author Muzafar
 * @Route("/{_locale}/page", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 *
 */
class PageController extends Controller
{
    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $sliderphotos = $em->getRepository('ModelBundle:Slider')->findAllActive();
        $hotelTabs = $em->getRepository('ModelBundle:Cms')->find(7);
        $testimonials = $em->getRepository('ModelBundle:Testimonial')->findAllActive();
        $homepagefacility = $em->getRepository('ModelBundle:Homepagefacility')->findAllActive();
        return array(
        	'sliderphotos' => $sliderphotos,
        	'hotelTabs'	   => $hotelTabs,
        	'testimonials' => $testimonials,
        	'homepagefacilities' => $homepagefacility,
        );
    }
    
    /**
     * @Route("/about")
     * @Template()
     */
    public function aboutAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Cms')->find(1);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Cms entity.');
    	}
    	return array(
    		'entity'      => $entity,
    	);
    }
    
    /**
     * @Route("/facilities")
     * @Template()
     */
    public function facilitiesAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Cms')->find(2);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Cms entity.');
    	}
    	return array(
    		'entity'      => $entity,
    	);
    }
    
    /**
     * @Route("/room/{title}", defaults={"title"="room1"})
     * @Template()
     */
    public function roomAction($title)
    {
    	return array('title'=>$title);
    }
    
    /**
     * @Route("/news/{slug}")
     * @Template()
     */
    public function newsAction($slug=null)
    {
    	$em = $this->getDoctrine()->getManager();
		
    	if($slug){
    		/* New Details */
    		$entity = $em->getRepository('ModelBundle:News')->findOneBySlug($slug);
    		if (!$entity) {
    			throw $this->createNotFoundException('Unable to find News entity.');
    		}
    		return array(
    			'entity'      => $entity,
    			'entities'	  => null,
    		);
    	}else{
    		/* News Loop */
	        $entities = $em->getRepository('ModelBundle:News')->findAll();
	        return array(
	            'entities' => $entities,
	        	'entity' => null,
	        );
    	}
    }
    
    /**
     * @Route("/gallery")
     * @Template()
     */
    public function galleryAction()
    {
    	$em = $this->getDoctrine()->getManager();
    		
	   	$entities = $em->getRepository('ModelBundle:Album')->findAllActive();
	    
	    return array(
	        'entities' => $entities,
	    );
    }
    
    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
    	if ($request->isMethod('POST')){
    		
    		$name = $this->get('request')->request->get('name');
    		$email = $this->get('request')->request->get('email');
    		$subject = $this->get('request')->request->get('subject');
    		$comments = $this->get('request')->request->get('comments');
    		
    		$todayDate = date('Y/m/d');
    		$message = \Swift_Message::newInstance()
	    		->setSubject($todayDate.' - NEW CONTACT RECIEVED!')
	    		->setFrom('noreply@renz.com.sa')
	    		->setTo(array(
	    			'reservation@renz.com.sa'=>'Reservation Manager',
	    		))
	    		->setBcc(array(
	    			'kimmuzafars@gmail.com'=>'Muzafar Ali',
	    		))
	    		->setBody(
	    				$this->renderView(
	    						'MainBundle:emails:new-contact.html.twig',
	    						array(
    								'name' => $name,
    								'email' => $email,
    								'subject' => $subject,
    								'comments' => $comments,
	    						)
	    				),
	    				'text/html'
	    		);
    		$this->get('mailer')->send($message);
    		
    		/*
    		 * Saving contact information
    		 * 
    		 */
    		$entity = new Contact();
    		
    		$entity->setName($name);
    		$entity->setEmail($email);
    		$entity->setSubject($subject);
    		$entity->setMessage($comments);
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    		/**************************************************************/
    		
    		$this->get('session')->getFlashBag()->set('error', '<p>Thank you <strong>'.$name.'</strong>, your message has been submitted to us.</p>');
    		return $this->redirect($this->generateUrl('renz_main_page_contact'));
    		
    		/* echo '
    		 	<div class="alert alert-danger alert-dismissable">
    			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Attention! There was an error while submitting the form!</div>
    		'; */
    		
    	}
    	
    	$em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('ModelBundle:Cms')->find(3);
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Cms entity.');
    	}
    	return array(
    		'entity'      => $entity,
    	);
    }
    
    /**
     * @Route("/newsletter")
     * @Template()
     */
    public function newsletterAction(Request $request)
    {
    	if ($request->isMethod('POST')){
    
    		$email = $this->get('request')->request->get('newsletter-email');
    
    		/*
    		 * Saving newletter information
    		*
    		*/
    		$entity = new Newsletter();
    		
    		$createdName = explode("@", $email);
    		$entity->setName($createdName[0]);
    		$entity->setEmail($email);
    		$entity->setCreatedAt(new \DateTime());
    		
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($entity);
    		$em->flush();
    		/**************************************************************/
    
    		$this->get('session')->getFlashBag()->set('error', '<p>Thank you <strong>'.$createdName[0].'</strong>, your subscription has been confirmed for future Newsletter!.</p>');
    		return $this->redirect($this->generateUrl('renz_main_page_newsletter'));
    	}
    }
}
