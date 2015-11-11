<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class UsuarioSignUpType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', 'text')
			->add('lastName', 'text')
			->add('email', 'email')
			->add('password', 'password')
			->add('playingLevel', 'rating', array(
        		'label' => 'Playing Level',
        		'stars' => 5))
			->add('gender', 'entity', array(
  				'class' => 'AppBundle:Gender',
  				'property' => 'name',
  				'expanded' => true
  				))
			->add('country', 'entity', array(
				'placeholder' => 'Choose an option',
  				'class' => 'AppBundle:Country',
  				'property' => 'name',
  				'query_builder' => function(EntityRepository $er){
  					return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
  				},
  				))
		;

		

		$builder
			->add('city', 'text')
			->add('send', 'submit')	
		;
		
	}
	
	public function getName()
	{
		return 'UsuarioSignUp';
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Usuario'
		));
	}
}
?>