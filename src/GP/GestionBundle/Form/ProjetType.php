<?php

namespace GP\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProjetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numDossier')
        		->add('nom')
        		->add('client', EntityType::class, array(
        				'class'        => 'GPGestionBundle:Client',
        				'choice_label' => 'nom',
        				'multiple'     => false,
        		))
        		->add('Pointvente', EntityType::class, array(
        				'class'        => 'GPGestionBundle:Pointvente',
        				'choice_label' => 'nom',
        				'multiple'     => false,
        		))
        		->add('commercial')
        		->add('dateDebutPose', DateType::class, [
        				'widget' => 'single_text',
        				'placeholder' => 'Sélectionner une date',
        				'attr' => [
        						'class' => 'form-control input-inline datepicker',
        						'data-provide' => 'datepicker',
        						'data-date-format' => 'yyyy-mm-dd'
        				]
        		])
        		->add('dateFinPose', DateType::class, [
        				'widget' => 'single_text',
        				'placeholder' => 'Sélectionner une date',
        				'attr' => [
        						'class' => 'form-control input-inline datepicker',
        						'data-provide' => 'datepicker',
        						'data-date-format' => 'yyyy-mm-dd'
        				]
        		])
		        ->add('descriptif')
		        ->add('numFacture')
		        ->add('dateFacturation', DateType::class, [
		        		'widget' => 'single_text',
		        		'placeholder' => 'Sélectionner une date',
		        		'attr' => [
		        				'class' => 'form-control input-inline datepicker',
		        				'data-provide' => 'datepicker',
		        				'data-date-format' => 'yyyy-mm-dd'
		        		]
		        ])
		        ->add('enregistrer',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GP\GestionBundle\Entity\Projet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gp_gestionbundle_projet';
    }


}
