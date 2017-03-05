<?php

namespace GP\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('gender', TextType::class, array(
                'label' => 'profile.fields.gender',
                'translation_domain' => 'forms'
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'profile.fields.firstname',
                'translation_domain' => 'forms'
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'profile.fields.lastname',
                'translation_domain' => 'forms'
            ))
            ->add('address', TextType::class, array(
                'label' => 'profile.fields.address',
                'translation_domain' => 'forms'
            ))
            ->add('zip_code', TextType::class, array(
                'label' => 'profile.fields.zip_code',
                'translation_domain' => 'forms'
            ))
            ->add('city', TextType::class, array(
                'label' => 'profile.fields.city',
                'translation_domain' => 'forms'
            ))
            ->add('country', TextType::class, array(
                'label' => 'profile.fields.country',
                'translation_domain' => 'forms'
            ))
            ->add('phone', TextType::class, array(
                'label' => 'profile.fields.phone',
                'translation_domain' => 'forms'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GP\MainBundle\Entity\User'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
}