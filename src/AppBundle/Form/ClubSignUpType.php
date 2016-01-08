<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class ClubSignUpType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('email', 'email')
			->add('password', 'password')
			->add('clubName', 'text')
			->add('amountCourts', 'text')
			->add('ownerName', 'text')
			->add('ownerLastName', 'text')
			->add('country', 'entity', array(
				'placeholder' => 'Choose an option',
  				'class' => 'AppBundle:Country',
  				'property' => 'name',
  				'query_builder' => function(EntityRepository $er){
  					return $er->createQueryBuilder('c')->orderBy('c.name', 'ASC');
  				},
  				))
			->add('city', 'text')
			->add('address', 'text')
			->add('postCode', 'text')
			->add('foundationDate', 'birthday', array('format' => 'ddMMyyyy', 'placeholder' => '----'))
			->add('send', 'submit')
		;
	}
	
	public function getName()
	{
		return 'clubSignup';
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => 'AppBundle\Entity\Club'
		));
	}
}
?>