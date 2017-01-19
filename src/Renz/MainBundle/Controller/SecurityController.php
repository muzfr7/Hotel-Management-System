<?php

namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext; /*added for login*/
use Symfony\Component\HttpFoundation\Request;
use Renz\ModelBundle\Entity\Customer;

/**
 * Login controller.
 * @return Response
 * @Route("/{_locale}/security", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
    	/**
    	 * Redirect user back to account page, if already LOGGED IN
    	 *
    	 * */
    	if ( $this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_account_index'));
    	}
    	
    	/*added for login*/
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	
    	// get the login error if there is one
    	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    		$error = $request->attributes->get(
    			SecurityContext::AUTHENTICATION_ERROR
    		);
    	} else {
    		$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    		$session->remove(SecurityContext::AUTHENTICATION_ERROR);
    	}
    	
    	return $this->render(
			'MainBundle:Security:login.html.twig',
    		array(
    			// last username entered by the user
    			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
    			'error'         => $error,
    		)
    	);
    }
    
    /**
     * Login check
     * 
     * @Route("/login_check")
     * 
     */
    public function logincheckAction(){
    	
    }
    
    /**
     * Logout Admin
     * 
     * @Route("/logout")
     * 
     * */
    public function logoutAction(){
    	
    }
    
    /**
     * @Route("/register")
     * @Template()
     */
    public function registerAction(Request $request)
    {
    	/**
    	 * Redirect user back to account page, if already LOGGED IN
    	 *
    	 * */
    	if ( $this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_account_index'));
    	}
    	 
    	$em = $this->getDoctrine()->getManager();
    	$countryEntities = $em->getRepository('ModelBundle:Country')->findAll();
    	 
    	if ($request->isMethod('POST')){
    		
    		$countryInstance = $em->getRepository('ModelBundle:Country')->findOneBy(array('id'=>$this->get('request')->request->get('country')));
    		
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
    		$newcustomer->setIsActive(1);
    		
    		$encoder = $this->container->get('security.encoder_factory')->getEncoder($newcustomer);
    		$newcustomer->setPassword($encoder->encodePassword($this->get('request')->request->get('paswd'), $newcustomer->getSalt()));
    		
    		$em->persist($newcustomer);
	    	$em->flush();
    		/**************************************************************/
    	
    		$this->get('session')->getFlashBag()->set('error', '<p>Your Account Have been created.. <a href="'.$this->generateUrl('renz_main_security_login').'">Click Here</a> to Login.</p>');
    		return $this->redirect($this->generateUrl('renz_main_security_register'));
    	
    	}
    	
    	return array(
    		'countries'	  => $countryEntities,
    	);
    }
    
    /**
     * check weather email already exist in db
     *
     * @Route("/checkemail")
     * @Template()
     */
    public function checkemailAction(Request $request){
    	
    	if ($request->isMethod('POST')){
    		$email = $this->get('request')->request->get('email');
    		
    		$em = $this->getDoctrine()->getManager();
    		$result = $em->createQuery('SELECT c.email FROM ModelBundle:Customer c WHERE c.email = :email')
    			->setParameters(array('email' => $email))
    			->getOneOrNullResult();
    		if($result['email']){
    			echo 'false';
    		}else{
    			echo 'true';
    		}
    	}
    	exit;
    }
    
    /**
     * @Route("/forgot-password-reset-request")
     * @Template()
     */
    public function forgotpasswordresetrequestAction(Request $request)
    {
    	/**
    	 * Redirect user back to login, if LOGGED IN
    	 *
    	 * */
    	if ( $this->get('security.context')->isGranted('ROLE_USER') ) {
    		return $this->redirect($this->generateUrl('renz_main_account_index'));
    	}
    	 
    	if ($request->isMethod('POST')){
    
    		$email = $this->get('request')->request->get('email');
    		
    		$em = $this->getDoctrine()->getManager();
    		$result = $em->createQuery('SELECT c.id, c.firstname, c.lastname, c.email FROM ModelBundle:Customer c WHERE c.email = :email')
    					 ->setParameters(array('email' => $email))
    					 ->getOneOrNullResult();
    		
    		if( $result['email']==$email ){
    			
    			$firstname = $result['firstname'];
    			$lastname = $result['lastname'];
    			
    			$resetcode = md5(date('d-m-Y H:i:s'));
    			
    			$customerEntity = $em->getRepository('ModelBundle:Customer')->find($result['id']);
    			if (!$customerEntity) {
    				throw $this->createNotFoundException('Unable to find Customer entity.');
    			}
    			
    			$customerEntity->setPasswordresetcode($resetcode);
    			
    			/*
    			 * Sending password reset email
    			 *
    			 * */
    			$message = \Swift_Message::newInstance()
    					->setSubject("Reset Your Password!")
    					->setFrom('noreply@renz.com.sa')
    					->setTo(array(
    						$email => $firstname,
    					))
    			->setBody(
    					$this->renderView(
    						'MainBundle:emails:password-reset.html.twig',
    						array(
		    					'name' => $firstname.' '.$lastname,
		    					'date' => date('d-m-Y H:i:s'),
    							'resetcode' => $resetcode,
    						)
    					),
    					'text/html'
    			);
    			$this->get('mailer')->send($message);
    			/***********************************************************/
    					
    			$em->flush();
    					
    			$this->get('session')->getFlashBag()->set('success', 'Password reset instructions sent to your email address, please check your inbox..');
    			return $this->redirect($this->generateUrl('renz_main_security_forgotpasswordresetrequest'));
    					
    		}else{
    			$this->get('session')->getFlashBag()->set('error', 'Email Not Found..!');
    			return $this->redirect($this->generateUrl('renz_main_security_forgotpasswordresetrequest'));
    		}
    		
    	}
    	 
    	return array();
    }
    
    
    
    /**
     * @Route("/forgot-password-reset/{resetcode}")
     * @Template()
     */
    public function forgotpasswordresetAction($resetcode, Request $request)
    {
    	if ($request->isMethod('POST')){
    		
    		$postedresetcode = $this->get('request')->request->get('postedresetcode');
    		$newPassword = $this->get('request')->request->get('new-password');
    		
    		$em = $this->getDoctrine()->getManager();
    		$result = $em->createQuery('SELECT c.id FROM ModelBundle:Customer c WHERE c.passwordresetcode = :passwordresetcode')
    					 ->setParameters(array('passwordresetcode' => $postedresetcode))
    					 ->getOneOrNullResult();
    		
    		if ( $result['id'] ){
    			
    			$customerEntity = $em->getRepository('ModelBundle:Customer')->find($result['id']);
    			if (!$customerEntity) {
    				throw $this->createNotFoundException('Unable to find Customer entity.');
    			}
    			
    			$encoder = $this->container->get('security.encoder_factory')->getEncoder($customerEntity);
    			$customerEntity->setPassword($encoder->encodePassword($newPassword, $customerEntity->getSalt()));
    			
    			$em->persist($customerEntity);
    			$em->flush();
    			
    			$this->get('session')->getFlashBag()->set('resetsuccessfull', 'Password Reset was Successfull');
    			return $this->redirect($this->generateUrl('renz_main_security_forgotpasswordresetrequest'));
    		}else{
    			
    			$this->get('session')->getFlashBag()->set('resetfailed', 'An Error occurred while reseting password..!');
    			return $this->redirect($this->generateUrl('renz_main_security_forgotpasswordresetrequest'));
    		}
    
    	}
    
    	return array(
    		'resetcode' => $resetcode,
    	);
    }
}