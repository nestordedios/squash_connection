<?php  
namespace AppBundle\Controller\Match;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Match;
use Doctrine\ORM\EntityRepository;

class MatchController extends Controller
{
	/**
	* @Route("/match", name="match_list")
	*/
	public function listMatchesAction(Request $request){
		$userId = $this->getUser()->getId();

		$matches = $this->getDoctrine()->getRepository('AppBundle:Match')->findUserMatches($userId);

		return $this->render('match/my_matches_list.html.twig', array('matches' => $matches));
	}
}

?>