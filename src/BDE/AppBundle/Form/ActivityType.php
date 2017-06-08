<?php

namespace BDE\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use BDE\AppBundle\Entity\Activity;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nom de l\'activité'))
            ->add('dateActivity', DateType::class, array('label' => 'Date de l\'activité'))
            ->add('price', MoneyType::class, array('label' => 'Prix'))
            ->add('description', TextType::class, array('label' => 'Description'))
            ->add('Envoyer', SubmitType::class)
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Activity::class,
        ));
    }
}