<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 17/12/2018
 * Time: 18:42
 */

namespace App\Form;

use App\Entity\Member;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
public function buildForm(FormBuilderInterface $builder, array $options)
{
        $builder
            ->add('lastName',TextType::class, array('required' => false, 'label_format'=>'lastName', 'attr' => array('class' => 'form-control')))
            ->add('firstName',TextType::class, array('required' => false, 'label_format'=>'firstName', 'attr' => array('class' => 'form-control')))
            ->add('newsletter',ChoiceType::class, array('required' => false,
                'label_format' => 'Newsletter',
                'placeholder'=>'Make a choice',
                'choices' => array(
                    'YES' => "1",
                    'NO' => "0",
                )
            ))
            ->add('addressNo',TextType::class, array('required' => false, 'label_format'=>'Number','attr' => array('class'=>'form-control')))
            ->add('streetName',TextType::class, array('required' => false, 'label_format'=>'Street name','attr' => array('class'=>'form-control')))
            ->add('locality',EntityType::class, array('class' => 'App:Locality',
                'placeholder'=>'--- list town ---',
                'property_path'=>'locality',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.locality', 'ASC');
                },
                'multiple'=>false,
                'attr'=>array('class'=>'form-control','data-live-search'=>true),
                'required' => false, 'label_format'=>'Locality'))

            ->add('postalCode',EntityType::class, ['class' => 'App:PostalCode',
                'placeholder'=>'--- list Postal Code ---',
                'property_path'=>'postalCode',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.postalCode', 'ASC');
                },
                'multiple'=>false,
                'attr'=> ['class'=>'form-control','data-live-search'=>true],
                'required' => false, 'label_format'=>'postal code'])

            //->add('avatar', FileType::class, array('required' => false))
            ->add('confirmed', SubmitType::class, array('attr' => array('class'=>'btn btn-primary')));
}


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Member'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_member';
    }


}
