<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityRepository;

class StageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('required' => false, 'label_format'=>'title'))
            ->add('description',TextareaType::class, array('required' => false, 'label_format'=>'Description'))
            ->add('price',TextType::class, array('required' => false, 'label_format'=>'price'))
            ->add('moreInfo',TextareaType::class, array('required' => false, 'label_format'=>'More infos'))
            ->add('toDate',DateType::class, array('required' => false, 'format' => 'dd / MM / yyyy', 'label_format'=>'To date',
                'placeholder' => array('day' => 'Jour', 'month' => 'Mois','year' => 'Année')))
            ->add('fromDate',DateType::class, array('required' => false, 'format' => 'dd / MM / yyyy', 'label_format'=>'From date',
                'placeholder' => array('day' => 'Jour', 'month' => 'Mois','year' => 'Année')))
            ->add('displayTo',DateType::class, array('required' => false, 'format' => 'dd / MM / yyyy', 'label_format'=>'to Display',
                'placeholder' => array('day' => 'Jour', 'month' => 'Mois','year' => 'Année')))
            ->add('displayFrom',DateType::class, array('required' => false, 'format' => 'dd / MM / yyyy', 'label_format'=>'From display',
                'placeholder' => array('day' => 'Jour', 'month' => 'Mois','year' => 'Année')))
            ->add('send', SubmitType::class, array('attr'=>array('class'=>'btn btn-primary pull-right')));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Stage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_stage';
    }


}
