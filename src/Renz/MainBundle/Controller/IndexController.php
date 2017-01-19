<?php
namespace Renz\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @author Muzafar
 * @Route("/{_locale}", defaults={"_locale"="en"}, requirements={"_locale"="en|ar"})
 *
 */
class IndexController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        //return $this->forward('MainBundle:Page:index');
        return new RedirectResponse($this->generateUrl('renz_main_page_index'));
    }
}
