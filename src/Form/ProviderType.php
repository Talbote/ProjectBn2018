<?php
/**
 * Created by PhpStorm.
 * User: odolinski
 * Date: 17/12/2018
 * Time: 18:42
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


class ProviderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('required' => false, 'label_format'=>'Name Company'))
            ->add('website',TextType::class, array('required' => false, 'label_format'=>'Your website'))
            ->add('eMail_contact',EmailType::class,array('required' => false, 'label_format'=>'Contact Email'))
            ->add('phoneNo',TextType::class,array('required' => false, 'label_format'=>'Number phones'))
            ->add('tvaNo',TextType::class, array('required' => false, 'label_format'=>'Number TVA'))
            ->add('newsletter',ChoiceType::class, array('required' => false,
                'label_format' => 'Newsletter',
                'placeholder'=>'Make a choice',
                'choices' => array(
                    'YES' => "1",
                    'NO' => "0",
                )
            ))
            ->add('services',EntityType::class,array('class'=>'App:Service',
                'placeholder'=>'--- List Services ---',
                'property_path'=>'services',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        //->where('u.valide = 1')
                        ->orderBy('u.name', 'ASC');
                },
                'multiple'=>true,
                'expanded'=>false,
                'attr'=>array('class'=>'form-control','data-live-search'=>true),
                'required' => false, 'label_format'=>'Categories services'))

            ->add('addressNo',TextType::class, array('required' => false, 'label_format'=>'address Number'))
            ->add('streetName',TextType::class, array('required' => false, 'label_format'=>'street name'))
            ->add('locality',EntityType::class, array('class' => 'App:Locality',
                'placeholder'=>'--- list localities ---',
                'property_path'=>'Locality',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.locality', 'ASC');
                },
                'multiple'=>false,
                'attr'=>array('class'=>'form-control','data-live-search'=>true),
                'required' => false, 'label_format'=>'Commune'))


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
            'data_class' => 'App\Entity\Provider'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_provider';
    }


}