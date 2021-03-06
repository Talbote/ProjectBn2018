<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('password', PasswordType::class, array('required' => false,'label_format'=>'Current password'))
                ->add('newPassword', PasswordType::class, array('required' => false,'label_format'=>'New password'))
                ->add('confNewPassword', PasswordType::class, array('required' => false,'label_format'=>'Confirm password'))
                ->add('Edit', SubmitType::class, array('attr' => array('class' => 'btn btn-default pull-right')));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\ChangePassword'
        ));
    }

}
