<?php  
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
	/**
	 * @Route("/login", name="login_route")
	 */
	 public function loginAction(Request $request)
	 {
	 	//If user is logged in... Log out the user
    	if($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')){
    		$this->get('security.token_storage')->setToken(null);
			$this->get('request')->getSession()->invalidate();
    	}
    	
	 	$authenticationUtils = $this->get('security.authentication_utils');

    	// get the login error if there is one
    	$error = $authenticationUtils->getLastAuthenticationError();

    	// last username entered by the user
    	$lastUsername = $authenticationUtils->getLastUsername();

    	return $this->render(
        	'security/login.html.twig',	array(
            	// last username entered by the user
            	'last_username' => $lastUsername,
            	'error'         => $error,
            	'request' => $request,
        	)
    	);
    	
	 }
	 
	/**
	 * @Route("/login_check", name="login_check")
	 */
	 public function loginCheckAction()
	 {
	 	throw new \Exception('This should never be reached!');
	 }
	 
	 /**
	  * @Route("/login_failure", name="login_failure")
	  */
	  public function loginFailureAction()
	  {
	  	return $this->render('security/login_failure.html.twig');
	  }
}
?>