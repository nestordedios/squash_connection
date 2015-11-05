<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioSignUpType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', 'text')
			->add('lastName', 'text')
			->add('email', 'email')
			->add('password', 'password')
			->add('playingLevel', 'choice', array(
				'empty_value' => '-',
				'choices' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
				))
			->add('gender', 'choice', array(
				'choices' => array('m' => 'Male', 'f' => 'Female'), 
				'expanded' => 'true',
				))
			->add('country', 'country')
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