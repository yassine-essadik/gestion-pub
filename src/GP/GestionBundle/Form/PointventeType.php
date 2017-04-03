<?php

namespace GP\GestionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use GP\GestionBundle\Repository\DepartementRepository;

class PointventeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
        		->add('adresse')
        		->add('codePostal')
        		->add('ville')
        		->add('region')->add('province')->add('pays')->add('telephone')->add('contact1')->add('contact2')
        		->add('email')->add('statut')->add('created')->add('modified')
        		->add('departement', EntityType::class, array(
        		'class'        => 'GPGestionBundle:Departement',
        		'choice_label' => 'nom',
        		'multiple'     => true,
        		))
        		->add('enregistrer',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GP\GestionBundle\Entity\Pointvente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'gp_gestionbundle_pointvente';
    }


}
