<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;



class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('email', EmailType::class, array('required' => false, 'label_format'=>'Email'))
            ->add('pwd', RepeatedType::class, array('required' => false, 'type' => PasswordType::class,
                'first_options'  => array('label_format' => 'Password'),
                'second_options' => array('label_format' => 'Confirm password')))
            ->add('user_type', ChoiceType::class, array(
                'label_format' => 'Type account',
                'choices' => array(
                    'Member' => 'members',
                    'Provider' => 'providers',
                ),
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\PreRegister'
        ));
    }

}
