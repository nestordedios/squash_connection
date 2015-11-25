<?php  
namespace AppBundle\Controller\User;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserSignUpType;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserController extends Controller
{
	/**
	 * @Route("/signup_player", name="signup_player")
	 */	
	public function playerSignUpAction(Request $request)
	{
		$user = new User();
		//$gender = new Gender();

		$form = $this->createForm(new UserSignUpType(), $user);
		
		$form->handleRequest($request);
		
		if($form->isValid())
		{
			//Encoding User Password
			$plainPassword = $request->request->get('UserSignUp')['password'];
			$encoder = $this->container->get('security.password_encoder');
			$encoded = $encoder->encodePassword($user, $plainPassword);

			$user->setPassword($encoded);
			$user->setStatus("ROLE_USER");
			//$user->setGender($gender);

			try {
				//Saving User in the DataBase
				$em = $this->getDoctrine()->getManager();
				$em->persist($user);
				$em->flush();

				$this->addFlash(
					'notice',
					'Well done! you completed your registration correctly. Welcome to Squash Connection!'
					);

				return $this->render('default/submitted_registration.html.twig');

			} catch (\Doctrine\DBAL\Exception\UniqueConstraintViolationException $e) {
				$this->addFlash(
					'error',
					'Something went wrong! It seems that someone is already using that email.'
					);

				return $this->render('default/submitted_registration.html.twig');
				
			}
			
		}
		
		return $this->render('user/user_registration.html.twig', array('form' => $form->createView(), 'request' => $request));
	}

	/**
	 * @Route("/user/homepage", name="user_homepage")
	 */
	public function playerHomepageAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$defaultData = array('message' => 'Mensaje');
		$form = $this->createFormBuilder($defaultData)
			->add('country', 'entity', array(
				'placeholder' => 'Choose a country',
  				'class' => 'AppBundle:Country',
  				'property' => 'name',
  				'query_builder' => function(EntityRepository $er){
  					return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
  				},
  				))
			->add('club', 'entity', array(
				'placeholder' => 'Choose a club',
  				'class' => 'AppBundle:Club',
  				'property' => 'clubname',
  				'query_builder' => function(EntityRepository $er){
  					return $er->createQueryBuilder('c');
  				},
  				))
			->add('gender', 'entity', array(
  				'class' => 'AppBundle:Gender',
  				'property' => 'name',
  				'expanded' => true
  				))
			->add('level', 'rating', array(
        		'label' => 'Playing Level',
        		'stars' => 5))
			->add('search', 'submit')
			->getForm();

		$form->handleRequest($request);

		if($form->isValid()){
			$data = $form->getData();
			$country = '';
			$club = '';
			$gender = '';
			$level = '';
			$dql = '';

			//Checking what fields the user is submitting and creating the Query to get the result of the search.
			if($data['country'] != null){
				$country = $data['country']->getCode();
				if($dql == ''){
					$dql = "Select u.id, u.name, u.lastName, g.name as gender, c.name as country, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where c.code = :country and u.country = c.code and g.code = u.gender";
				}
			}
			if($data['club'] != null){
				$club .= $data['club']->getClubName();
				if($dql == ''){
					$dql .= "Select u.id, u.name, u.lastName, g.name as gender, c.name as country, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where u.club = :club and u.country = c.code and g.code = u.gender";
				}else{
					$dql .= " and u.club = :club";
				}
			}
			if($data['gender'] != null){
				$gender = $data['gender']->getCode();
				if($dql == ''){
					$dql .= "Select u.id, u.name, u.lastName, g.name as gender, c.name as country, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where g.code = :gender and u.country = c.code and g.code = u.gender";
				}else{
					$dql .= " and g.code = :gender";
				}
			}
			if($data['level'] != null){
				$level = round($data['level']);
				if($dql == ''){
					$dql .= "Select u.id, u.name, u.lastName, g.name as gender, c.name as country, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where u.playingLevel = :level and u.country = c.code and g.code = u.gender";
				}else{
					$dql .= " and u.playingLevel = :level";
				}
			}

			if($dql == ''){
				$dql = "Select u.id, u.name, u.lastName, g.name as gender, c.name as country, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where u.country = c.code and g.code = u.gender";
			}

			$query = $em->createQuery($dql);
			
			if($country != ''){
				$query->setParameter('country', $country);
			}
			if($club != ''){
				$query->setParameter('club', $club);
			}
			if($gender != ''){
				$query->setParameter('gender', $gender);
			}
			if($level != ''){
				$query->setParameter('level', $level);
			}

			$players = $query->getResult();

			return $this->render('user/searched_players_list.html.twig', array('form' => $form->createView(), 'data' => $data, 'query' => $query, 'players' => $players));
		}

		$players = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

		return $this->render('user/user_homepage.html.twig', array('form' => $form->createView(), 'players' => $players));
	}

}
?>