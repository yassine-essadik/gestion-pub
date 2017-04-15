<?php

namespace GP\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
        		'multiple'     => true
        		))
        		->add('dateDebut', DateType::class, [
        				'widget' => 'single_text',
        				'placeholder' => 'Sélectionner une date',
        				'format' => 'dd-MM-yyyy HH:mm:ss',
        				'attr' => [
        						'class' => 'form-control input-inline datetimepicker',
        				]
        		])
        		->add('dateFin', DateType::class, [
        				'widget' => 'single_text',
        				'placeholder' => 'Sélectionner une date',
        				'format' => 'dd-MM-yyyy HH:mm:ss',
        				'attr' => [
        						'class' => 'form-control input-inline datetimepicker',
        				]
        		])
	        	->add('laissezPasserValide')
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
		        		'format' => 'dd-MM-yyyy',
		        		'attr' => [
		        				'class' => 'form-control input-inline datepicker',
		        				'data-provide' => 'datepicker',
		        				'data-date-format' => 'dd-mm-yyyy'
		        		]
		        ])
		        ->add('type', EntityType::class, array(
		        		'class'        => 'GPGestionBundle:InterventionType',
		        		'choice_label' => 'nom',
		        		'multiple'     => false
		        ))
		        ->add('commentaire')
		        ->add('brief')
		        ->add('projet', EntityType::class, array(
		        		'class'        => 'GPGestionBundle:Projet',
		        		'choice_label' => 'nom',
		        		'multiple'     => false
		        ))
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
