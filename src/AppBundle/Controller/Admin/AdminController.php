<?php 
namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;

class AdminController extends Controller
{
	
	 /**
	 * @Route("/admin/homepage", name="admin_homepage")
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
					$dql = "Select u.id, u.name, u.email, u.lastName, u.status, g.name as gender, c.name as country, u.city, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where c.code = :country and u.country = c.code and g.code = u.gender";
				}
			}
			if($data['club'] != null){
				$club .= $data['club']->getClubName();
				if($dql == ''){
					$dql .= "Select u.id, u.name, u.email, u.lastName, u.status, g.name as gender, c.name as country, u.city, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where u.club = :club and u.country = c.code and g.code = u.gender";
				}else{
					$dql .= " and u.club = :club";
				}
			}
			if($data['gender'] != null){
				$gender = $data['gender']->getCode();
				if($dql == ''){
					$dql .= "Select u.id, u.name, u.email, u.lastName, u.status, g.name as gender, c.name as country, u.city, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where g.code = :gender and u.country = c.code and g.code = u.gender";
				}else{
					$dql .= " and g.code = :gender";
				}
			}
			if($data['level'] != null){
				$level = round($data['level']);
				if($dql == ''){
					$dql .= "Select u.id, u.name, u.email, u.lastName, u.status, g.name as gender, c.name as country, u.city, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where u.playingLevel = :level and u.country = c.code and g.code = u.gender";
				}else{
					$dql .= " and u.playingLevel = :level";
				}
			}

			if($dql == ''){
				$dql = "Select u.id, u.name, u.email, u.lastName, u.status, g.name as gender, c.name as country, u.city, u.playingLevel from AppBundle:User u, AppBundle:Country c, AppBundle:Gender g where u.country = c.code and g.code = u.gender";
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

			return $this->render('admin/admin_searched_players_list.html.twig', array('form' => $form->createView(), 'data' => $data, 'query' => $query, 'players' => $players));
		}

		$players = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

		return $this->render('admin/admin_homepage.html.twig', array('form' => $form->createView(), 'players' => $players, 'request' => $request));
	}
}

?>