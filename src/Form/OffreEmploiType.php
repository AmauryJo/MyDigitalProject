<?php

namespace App\Form;

use App\Entity\OffreEmploi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;
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
            ->add('offre_remuneration', TextType::class, [ 
                'label' => 'Rémunération de l\'offre',
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Range(['min' => 0, 'max' => 100000]),
                ],
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '102400k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPG, JPEG, PNG, GIF)',
                    ]),
                ],
                'attr' => [
                    'accept' => 'image/jpeg, image/png, image/gif',
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
