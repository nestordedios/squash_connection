<?php  
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ChallengeType extends AbstractType
{
	//Generating Form Based on the User data
	private $tokenStorage;

	public function __construct(TokenStorageInterface $tokenStorage)
	{
		$this->tokenStorage = $tokenStorage;
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$user = $this->tokenStorage->getToken()->getUser();
		if(!$user){
			throw new \LogicException(
				'The ChallengeType cannot be used without an authenticated user!'
			);
		}

		$builder
			->add('date', 'date', array('format' => 'ddMMyyyy', 'years' => range(date('Y'), date('Y')+10), 'months' => range(date('m'), 12)))
			->add('time', 'time')		
			->add('message', 'textarea')
			->addEventListener(
			FormEvents::PRE_SET_DATA, 
			function (FormEvent $event) use ($user){
				$form = $event->getForm();
				$formOptions = array(
					'class' => 'AppBundle\Entity\Club',
					'property' => 'clubName',
					'query_builder' => function(EntityRepository $er) use ($user){
						$userCountry = $user->getCountry()->getCode();
						return $er->createQueryBuilder('c')
							->where("c.country = '$userCountry'");
					},
				);

				$form->add('club', 'entity', $formOptions);
			}
			)
			->add('challenge', 'submit', array('attr' => array('class' => 'btn btn-primary')))
		;

	}

	public function getName()
	{
		return 'challenge';
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Challenge'
		));
	}
}

?>