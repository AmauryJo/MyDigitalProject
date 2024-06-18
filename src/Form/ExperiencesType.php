<?php

namespace App\Form;

use App\Entity\Demandeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperiencesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('experience', TextareaType::class, [
                'attr' => ['class' => 'form-control'],
                'required' => false,
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Assurez-vous que la classe de données est correctement configurée
            'data_class' => Demandeur::class
        ]);
    }
}