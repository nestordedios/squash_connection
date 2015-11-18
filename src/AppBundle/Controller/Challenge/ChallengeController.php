<?php 
namespace AppBundle\Controller\Challenge;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Challenge;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\ChallengeType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
* 
*/
class ChallengeController extends Controller
{
	/**
	* @Route("/user/challenge/{slug}", name="challenge", requirements={"slug": "\d+"})
	*/
	public function challengeAction(Request $request, $slug)
	{
		$player = $this->getDoctrine()->getRepository('AppBundle:Usuario')->find($slug);
		$challenge = new Challenge();
		$user = $this->getUser();
		$tokenStorage = $this->container->get('security.token_storage');

		$form = $this->createForm(new ChallengeType($tokenStorage), $challenge);

		$form->handleRequest($request);

		if($form->isValid()){
			
			$data = $form->getData();
			$challenge->setPlayer1($user->getId());
			$challenge->setPlayer2($request->get('player2'));
			$challenge->setPublishedDate(new \DateTime('now'));

			try {
				//Saving Challenge in the DataBase
				$em = $this->getDoctrine()->getManager();
				$em->persist($challenge);
				$em->flush();

				$this->addFlash(
					'notice',
					'Your request was sent correctly.'
					);

				return $this->render('user/challenge_notification.html.twig', array('icon' => "fa fa-check fa-2x", 'class' => "text-success"));

			} catch (Exception $e) {
				$this->addFlash(
					'error',
					'Something went wrong!'
					);

				return $this->render('user/challenge_notification.html.twig', array('icon' => "fa fa-exclamation-circle fa-2x", 'class' => "text-danger"));				
			}
		}

		return $this->render('user/user_challenge.html.twig', array('form' => $form->createView(), 'slug' => $slug, 'player' => $player));
		
	}

	/**
	* @Route("/user/challenge/list", name="challenge_list")
	*/
	public function challengeListAction(Request $request)
	{
		$user = $this->getUser()->getId();
		$challenges = $this->getDoctrine()->getRepository('AppBundle:Challenge')->findBy(array('player2' => $user));

		return $this->render('challenge/challenge_list.html.twig', array('userId' => $user, 'challenges' => $challenges));
	}
}

?>