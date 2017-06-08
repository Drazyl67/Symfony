<?php

namespace BDE\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('lastName', TextType::class, array('label' => 'Nom'));
        $builder->add('firstName', TextType::class, array('label' => 'Prénom'));
        $builder->add('email');
        $builder->add('promotion', IntegerType::class, array('label' => 'Année à l\'exia', 'attr' => array(
        'min' => 1,
        'max' => 5)));
        $builder->add('address', TextType::class, array('label' => 'Adresse'));
        $builder->add('postalCode', IntegerType::class, array('label' => 'Code postal'));
        $builder->add('phoneNumber', IntegerType::class, array('label' => 'Téléphone'));
        $builder->add('city', TextType::class, array('label' => 'Ville'));
    }

    public function getBlockPrefix()
    {
        return 'bde_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
}