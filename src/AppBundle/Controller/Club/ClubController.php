<?php
namespace AppBundle\Controller\Club;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ClubSignUpType; //We can use the Form class we created in that directory
use AppBundle\Entity\Club;

class ClubController extends Controller
{
	/**
	 * @Route("/signup_club", name="signup_club")
	 */
	 function signupAction(Request $request)
	 {
	 	$club = new Club();
	 	$form = $this->createForm(new ClubSignUpType(), $club);
		
		$form->handleRequest($request);
		
		if($form->isValid())
		{
			//Encoding User Password
			$plainPassword = $request->request->get('ClubSignUp')['password'];
			$encoder = $this->container->get('security.password_encoder');
			$encoded = $encoder->encodePassword($club, $plainPassword);

			$club->setPassword($encoded);
			$club->sertStatus("ROLE_CLUB");
			
			//Saving User in the DataBase
			$em = $this->getDoctrine()->getManager();
			$em->persist($club);
			$em->flush();
			
			return $this->render('club/correct_club_registration.html.twig');
		}
		
		return $this->render('club/club_registration.html.twig', array('form' => $form->createView()));
	 }
}
?>