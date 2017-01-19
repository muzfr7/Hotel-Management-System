<?php

namespace Renz\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext; /*added for login*/

/**
 * Login controller.
 * @return Response
 * @Route("/security")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/login")
     * @Template()
     */
    public function loginAction()
    {
    	/*added for login*/
    	$request = $this->getRequest();
    	$session = $request->getSession();
    	
    	/* var_dump($request);
    	exit; */
    	
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
			'AdminBundle:Security:login.html.twig',
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
}
