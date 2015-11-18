<?php 
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class SearchPlayersType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
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
  				'property' => 'name',
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
		;
		
	}
	
	public function getName()
	{
		return 'SearchPlayer';
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			
		));
	}
}
?>