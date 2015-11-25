<?php 
namespace AppBundle\Controller\Challenge;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Challenge;
use AppBundle\Entity\Match;
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
			$challenge->setClub($data->getClub()->getId());

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
		$userId = $this->getUser()->getId();
		$challenges = $this->getDoctrine()->getRepository('AppBundle:Challenge')->findUserChallenges($userId);

		return $this->render('challenge/challenge_list.html.twig', array('userId' => $userId, 'challenges' => $challenges));
	}

	/**
	* @Route("/user/mychallenge/list", name="my_challenge_list")
	*/
	public function myChallengeListAction(Request $request)
	{
		$userId = $this->getUser()->getId();
		$challenges = $this->getDoctrine()->getRepository('AppBundle:Challenge')->findMyChallenges($userId);

		return $this->render('challenge/my_challenge_list.html.twig', array('userId' => $userId, 'challenges' => $challenges));
	}

	/**
	* @Route("user/challenge/accept/{slug}", name="challenge_accept")
	*/
	public function challengeAcceptAction(Request $request, $slug)
	{
		$em = $this->getDoctrine()->getManager();
		$challenge = $em->getRepository('AppBundle:Challenge')->find($slug);
		$match = new Match();
		$match->setPlayer1($challenge->getPlayer1());
		$match->setPlayer2($challenge->getPlayer2());
		$match->setClub($challenge->getClub());
		$match->setDate($challenge->getDate());
		$match->setTime($challenge->getTime());

		if(!$challenge){
			throw $this->createNotFoundException(
				"No challenge found for id" . $slug
			);
			
		}

		$challenge->setStatus("Accepted");
		$em->persist($match);
		$em->flush();

		$userId = $this->getUser()->getId();
		$challenges = $this->getDoctrine()->getRepository('AppBundle:Challenge')->findUserChallenges($userId);

		return $this->render('challenge/challenge_list.html.twig', array('data' => $request, 'userId' => $userId, 'challenges' => $challenges));

	}

	/**
	* @Route("user/challenge/deny/{slug}", name="challenge_deny")
	*/
	public function challengeDenyAction(Request $request, $slug)
	{
		$em = $this->getDoctrine()->getManager();
		$challenge = $em->getRepository('AppBundle:Challenge')->find($slug);

		if(!$challenge){
			throw $this->createNotFoundException(
				"No challenge found for id" . $slug
			);
		}

		$challenge->setStatus('Denied');
		$em->flush();

		$userId = $this->getUser()->getId();
		$challenges = $this->getDoctrine()->getRepository('AppBundle:Challenge')->findUserChallenges($userId);

		return $this->render('challenge/challenge_list.html.twig', array('userId' => $userId, 'challenges' => $challenges));

	}

}

?>