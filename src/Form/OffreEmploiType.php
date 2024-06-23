<?php

namespace App\Form;

use App\Entity\OffreEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class OffreEmploiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('offre_intitule', TextType::class, [
                'label' => 'Intitulé de l\'offre',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('offre_description', TextareaType::class, [
                'label' => 'Description de l\'offre',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('presentation_entreprise', TextareaType::class, [
                'label' => 'Présentation de l\'entreprise',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('mission_offre', TextareaType::class, [
                'label' => 'Mission de l\'offre',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('offre_remuneration', NumberType::class, [ 
                'label' => 'Rémunération de l\'offre',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Range(['min' => 0, 'max' => 100000]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OffreEmploi::class,
        ]);
    }
}
