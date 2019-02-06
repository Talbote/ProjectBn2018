<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 17/12/2018
 * Time: 18:42
 */

namespace App\Form;

use App\Entity\Service;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service', TextType::class, array('required' => false, 'label_format'=>'Service list',
                'attr' => array('style' => 'border: 2px solid grey')))
            ->add('description', TextareaType::class, array('required' => false, 'label_format'=>'Description service',
                'attr' => array('style' => 'border: 2px solid grey')))
            ->add('Envoyer', SubmitType::class, array('attr' => array('class'=>'btn btn-primary')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Service'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_services';
    }
}
