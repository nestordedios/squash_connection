<?php  
namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UsuarioSignUpType;
use AppBundle\Entity\Usuario;

class UserController extends Controller
{
	/**
	 * @Route("/signup_player", name="signup_player")
	 */	
	public function playerSignUpAction(Request $request)
	{
		$user = new Usuario();
		
		$form = $this->createForm(new UsuarioSignUpType(), $user);
		
		$form->handleRequest($request);
		
		if($form->isValid())
		{
			//Encoding User Password
			$plainPassword = $request->request->get('UsuarioSignUp')['password'];
			$encoder = $this->container->get('security.password_encoder');
			$encoded = $encoder->encodePassword($user, $plainPassword);

			$user->setPassword($encoded);
			$user->setStatus("ROLE_USER");
			
			//Saving User in the DataBase
			$em = $this->getDoctrine()->getManager();
			$em->persist($user);
			$em->flush();

			return $this->render('user/correct_user_registration.html.twig');
		}
		
		return $this->render('user/user_registration.html.twig', array('form' => $form->createView(), 'request' => $request));
	}
	/**
	 * @Route("/user/homepage", name="user_homepage")
	 */
	public function playerHomepageAction(Request $request)
	{
		$players = $this->getDoctrine()->getRepository('AppBundle:Usuario')->findAll();
		return $this->render('user/user_homepage.html.twig', array('players' => $players));
	}
}
?>