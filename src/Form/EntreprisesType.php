<?php

namespace App\Form;

use App\Entity\Entreprises;
use App\Entity\OffreEmploi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntreprisesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entr_password')
            ->add('entr_tel')
            ->add('entr_mail')
            ->add('entr_nom')
            ->add('entr_secteurActivite')
            ->add('entr_nombreEmploye')
            ->add('entreprise', EntityType::class, [
                'class' => OffreEmploi::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprises::class,
        ]);
    }
}
