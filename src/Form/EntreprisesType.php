<?php

namespace App\Form;

use App\Entity\Entreprises;
use App\Entity\OffreEmploi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class EntreprisesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entr_password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => true,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('entr_tel')
            ->add('entr_mail')
            ->add('entr_nom')
            ->add('entr_secteurActivite', ChoiceType::class, [
                'choices' => [
                    'Agroalimentaire' => 'agroalimentaire',
                    'Banque / Assurance' => 'banque_assurance',
                    'Bois / Papier / Carton / Imprimerie' => 'bois_papier_carton_imprimerie',
                    'BTP / Matériaux de construction' => 'btp_materiaux_construction',
                    'Chimie / Parachimie' => 'chimie_parachimie',
                    'Commerce / Négoce / Distribution' => 'commerce_negoce_distribution',
                    'Édition / Communication / Multimédia' => 'edition_communication_multimedia',
                    'Électronique / Électricité' => 'electronique_electricite',
                    'Études et conseils' => 'etudes_conseils',
                    'Industrie pharmaceutique' => 'industrie_pharmaceutique',
                    'Informatique / Télécoms' => 'informatique_telecoms',
                    'Machines et équipements / Automobile' => 'machines_equipements_automobile',
                    'Métallurgie / Travail du métal' => 'metallurgie_travail_metal',
                    'Plastique / Caoutchouc' => 'plastique_caoutchouc',
                    'Services aux entreprises' => 'services_entreprises',
                    'Textile / Habillement / Chaussure' => 'textile_habillement_chaussure',
                    'Transports / Logistique' => 'transports_logistique'
                ],
            ])            
            ->add('entr_nombreEmploye', ChoiceType::class, [
                'choices' => [
                    'Micro-entreprise' => 'micro',
                    'Petite entreprise' => 'petite',
                    'Moyenne entreprise' => 'moyenne',
                    'Grande entreprise' => 'grande'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprises::class,
        ]);
    }
}
