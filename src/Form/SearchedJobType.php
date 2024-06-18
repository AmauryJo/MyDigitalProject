<?php

namespace App\Form;

use App\Entity\Demandeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SearchedJobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitulePoste', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Non renseigné', 'class' => 'inputForm']
            ])
            ->add('localisationJob', TextType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Non renseigné', 'class' => 'inputForm']
            ])
            ->add('typeContrat', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'choices' => [
                    'CDI' => 'cdi',
                    'CDD' => 'cdd',
                    'Freelance' => 'freelance',
                    'Stage' => 'stage',
                    'Alternance' => 'alternance'
                ],
                'attr' => ['placeholder' => 'Non renseigné', 'class' => 'inputForm']
            ])
            ->add('teletravail', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'choices' => [
                    'Oui' => 'oui',
                    'Non' => 'non',
                    'Possiblement' => 'possiblement'
                ],
                'attr' => ['placeholder' => 'Non renseigné', 'class' => 'inputForm']
            ])
            ->add('nivExperience', ChoiceType::class, [
                'required' => false,
                'label' => false,
                'choices' => [
                    '1 an' => '1_ans',
                    '+2 ans' => '2_ans',
                    '+3 ans' => '3_ans'
                ],
                'attr' => ['placeholder' => 'Non renseigné', 'class' => 'inputForm']
            ])
            ->add('detailJob', TextareaType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Non renseigné', 'class' => 'textArea']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demandeur::class,
        ]);
    }
}