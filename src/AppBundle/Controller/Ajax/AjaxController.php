<?php  
namespace AppBundle\Controller\Ajax;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\MatchResult;


class AjaxController extends Controller
{
	/**
	* @Route("/match/change-result", name="change-result")
	*/
	public function changeResultAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$id = $request->request->get('id');
		$player1 = $request->request->get('player1');
		$result = $request->request->get('result');
		$user = $this->getUser();
		$userName = $user->getName();
		$userName .= " " . $user->getLastName();
		$match = $em->getRepository('AppBundle:Match')->find($id);
		$match->setStatus('Played');
		$prueba = "Vacio";
		if($userName == $player1){			
			if($result == 'WON'){
				$match->setResultPlayer1('WON');
				$match->setResultPlayer2('LOST');
				$prueba = "1 gana";
			}elseif ($result == 'LOST'){
				$match->setResultPlayer1('LOST');
				$match->setResultPlayer2('WON');
				$prueba = "1 pierde";
			}			
		}else{
			if($result == 'WON'){
				$match->setResultPlayer1('LOST');
				$match->setResultPlayer2('WON');
				$prueba = "2 gana";
			}elseif ($result == 'LOST'){
				$match->setResultPlayer1('WON');
				$match->setResultPlayer2('LOST');
				$prueba = "2 pierde";
			}	
		}

		$em->persist($match);
		$em->flush();

		$response = new JsonResponse();
		$response->setData(array('texto' => "Ha venido AJAX con $prueba" ));

		return $response;
	}

	/**
	* @Route("/admin/lock-user", name="lock_user")
	*/
	public function blockUserAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$id = $request->request->get('id');

		$user = $em->getRepository('AppBundle:User')->find($id);
		$user->setStatus('ROLE_LOCKED');
		$em->flush();

		$response = new JsonResponse();
		$response->setData(array('texto' => "Bloqueado!!"));

		return $response;
	}

	/**
	* @Route("admin/unlock-user", name="unlock-user")
	*/
	public function unlockUserAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$id = $request->request->get('id');

		$user = $em->getRepository('AppBundle:User')->find($id);
		$user->setStatus("ROLE_USER");

		$em->flush();

		$response = new JsonResponse();
		$response->setData(array('texto' => "Desbloqueado"));

		return $response;
	}
}

?>