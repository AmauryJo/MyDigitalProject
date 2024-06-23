<?php

namespace App\Form;

use App\Entity\Entreprises;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InfoEntreprisesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('telephone')
        ->add('entr_mail')
        ->add('secteur_activite', ChoiceType::class, [
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
        ->add('nombre_employe', ChoiceType::class, [
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