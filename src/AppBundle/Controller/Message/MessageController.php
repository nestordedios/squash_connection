<?php 
namespace AppBundle\Controller\Message;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Message;
use AppBundle\Form\MessageType;

class MessageController extends Controller
{
	/**
	* @Route("/send-message/{slug}", name="send_message")
	*/
	public function sendMessageAction(Request $request, $slug){

		$message = new Message();
		//$gender = new Gender();

		$form = $this->createForm(new MessageType(), $message);
		
		$form->handleRequest($request);

		if($form->isValid())
		{
			$senderId = $this->getUser()->getId();
			$text = $request->request->get('message')['message'];
			$message->setSenderId($senderId);
			$message->setReceiverId($slug);
			$message->setStatus(0);
			$message->setMessage($text);
			$message->setDate(new \DateTime('now'));			
			
			try {
				$em = $this->getDoctrine()->getManager();
				$em->getRepository('AppBundle:Message');
				$em->persist($message);
				$em->flush();				

				$this->addFlash(
					'notice',
					'Your message has been sent successfully!'
					);

				return $this->render('message/message_notification.html.twig', array('icon' => "fa fa-check fa-2x", 'class' => "text-success"));

			} catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
				$this->addFlash(
					'error',
					'It was not possible to send the message, try it again.'
					);

				return $this->render('message/message_notification.html.twig', array('icon' => "fa fa-exclamation-circle fa-2x", 'class' => "text-danger"));
			}
			
		}

		return $this->render('message/send_message.html.twig', array('form' => $form->createView(), 'request' => $request));
	}

	/**
	* @Route("/user/message", name="user_messages")
	*/
	public function listMessagesAction(Request $request){
		$userId = $this->getUser()->getId();
		$messages = $this->getDoctrine()->getRepository('AppBundle:Message')->getUserMessages($userId);

		return $this->render('message/message_list.html.twig', array('userId' => $userId, 'messages' => $messages));
	}

	/**
	* @Route("/message/{slug}", name="read_message")
	*/
	public function readMessageAction(Request $request, $slug){
		$em = $this->getDoctrine()->getEntityManager();
		$message = $em->getRepository('AppBundle:Message')->find($slug);
		$message->setStatus(1);
		$em->flush();

		$messageToRead = $this->getDoctrine()->getRepository('AppBundle:Message')->getMessageById($slug);

		return $this->render('message/message_read.html.twig', array('message' => $messageToRead));
	}

	/**
	* @Route("user/challenge/message{slug}", name="challenge_message")
	*/
	public function readChallengeMessageAction(Request $request, $slug){
		$em = $this->getDoctrine()->getEntityManager();
		$messages = $em->getRepository('AppBundle:Message')->getChallengeMessages($slug);
		
		return $this->render('message/challenge_message_read.html.twig', array('messages' => $messages));
	}
}

?>