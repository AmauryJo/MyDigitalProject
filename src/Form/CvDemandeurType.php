<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Demandeur;

class CvDemandeurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('cvFile', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => false,
            ])
            ->add('linkedinProfile', TextType::class, [
                'label' => false,
                'required' => false,
            ])
            ->add('website', TextType::class, [
                'label' => false,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demandeur::class,
        ]);
    }
}
