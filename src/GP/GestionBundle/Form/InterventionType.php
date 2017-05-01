<?php

namespace GP\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class InterventionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('poseurs', EntityType::class, array(
        		'class'        => 'GPGestionBundle:Poseur',
        		'choice_label' => 'nomcomplet',
        		'multiple'     => true,
        		'attr' => array('class' => 'chosen-select'),
        		))
        		->add('dateDebut', DateTimeType::class, [
        				'widget' => 'single_text',
        				'placeholder' => 'Sélectionner une date',
        				'attr' => [
        						'class' => 'form-control input-inline datetimepicker',
        				]
        		])
        		->add('dateFin', DateTimeType::class, [
        				'widget' => 'single_text',
        				'placeholder' => 'Sélectionner une date',
        				'attr' => [
        						'class' => 'form-control input-inline datetimepicker',
        				]
        		])
	        	->add('laissezPasserValide', choiceType::class, array(
					    'choices'  => array(
					        'Oui' => 1,
					        'Non' => 0,
					    )
		        	))
		        ->add('laissezPasserValidePar')
		        ->add('contactUrgence')
		        ->add('statut', EntityType::class, array(
		        		'class'        => 'GPGestionBundle:InterventionStatut',
		        		'choice_label' => 'nom',
		        		'multiple'     => false
		        ))
		        ->add('dateDemande', DateType::class, [
		        		'widget' => 'single_text',
		        		'placeholder' => 'Sélectionner une date',
		        		'attr' => [
		        				'class' => 'form-control input-inline datepicker',
		        				'data-provide' => 'datepicker',
		        				'data-date-format' => 'yyyy-mm-dd'
		        		]
		        ])
		        ->add('type', EntityType::class, array(
		        		'class'        => 'GPGestionBundle:InterventionType',
		        		'choice_label' => 'nom',
		        		'multiple'     => false
		        ))
		        ->add('commentaire')
		        ->add('brieffile')
		        ->add('projet', EntityType::class, array(
		        		'class'        => 'GPGestionBundle:Projet',
		        		'choice_label' => 'nom',
		        		'multiple'     => false
		        ))
		        ->add('image_avant_file')
		        ->add('image_apres_file')
		        ->add('enregistrer',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GP\GestionBundle\Entity\Intervention'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gp_gestionbundle_intervention';
    }


}
