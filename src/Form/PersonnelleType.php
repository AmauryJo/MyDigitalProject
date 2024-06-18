<?php

namespace App\Form;

use App\Entity\Demandeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class PersonnelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                    'Autre' => 'autre'
                ],
                'required' => false,
                'attr' => [
                    'placeholder' => 'Sélectionnez un genre',
                    'class' => 'custom-select-form customForm',
                ],
                'label' => false,
            ])
            ->add('date_de_naissance', DateType::class, [
                'widget' => 'single_text', // Utilisez un widget de type 'single_text' pour une saisie directe
                'required' => false,
                'attr' => [
                    'placeholder' => 'Sélectionnez une date de naissance',
                    'class' => 'form-control', // Classe adaptée pour les inputs de type date
                ],
                'label' => false,
                'format' => 'yyyy-MM-dd', // Format de la date
                'html5' => true, // Assurez-vous que le champ utilise l'input HTML5 de type date
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demandeur::class,
        ]);
    }
}