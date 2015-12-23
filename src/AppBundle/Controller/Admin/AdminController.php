<?php 
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
	/**
	* @Route("/admin", name="admin_login")
	*/
	public function adminLoginAction(Request $request)
	{
		$authenticationUtils = $this->get('security.authentication_utils');

		$error = $authenticationUtils->getLastAuthenticationError();

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
	 * @Route("/admin/login_check", name="admin_login_check")
	 */
	 public function loginCheckAction()
	 {
	 	throw new \Exception('This should never be reached!');
	 }
	 
	 /**
	  * @Route("/admin/login_failure", name="admin_login_failure")
	  */
	  public function loginFailureAction()
	  {
	  	return $this->render('security/login_failure.html.twig');
	  }
}

?>