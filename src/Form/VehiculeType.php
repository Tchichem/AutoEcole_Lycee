<?php

namespace App\Form;

use App\Entity\MODELE;
use App\Entity\VEHICULE;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VehiculeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('num_immatric', TextType::class, ['label' => 'Numéro d\'immatriculation'])
            ->add('modele_vehic', EntityType::class, [
                'class' => MODELE::class,
                'choice_label' => 'modele_vehic',
                'label' => 'Modèle',
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'État',
                'choices' => [
                    'En service' => true,
                    'Hors service' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VEHICULE::class,
        ]);
    }
}
