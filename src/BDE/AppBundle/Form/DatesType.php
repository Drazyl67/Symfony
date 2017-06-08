<?php

namespace BDE\AppBundle\Form;

use BDE\AppBundle\Entity\DateProposal;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DatesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateProposal', DateType::class, array(
                'widget' => 'choice', 
                ))
            ->add('timeProposal', ChoiceType::class, array(
                     'choices' => array('m' => 'Matin', 'a' => 'Après-midi'),
                     'expanded' => true,
                     'multiple' => false
             ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DateProposal::class,
        ));
    }
}