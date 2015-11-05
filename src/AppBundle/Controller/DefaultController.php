<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
    	//If user is logged in... Log out the user
    	if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
    		$this->get('security.token_storage')->setToken(null);
			$this->get('request')->getSession()->invalidate();
			dump("hola");
    	}
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'error' => '',
        ));
    }
}
