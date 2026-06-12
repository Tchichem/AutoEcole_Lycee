<?php

namespace App\Form;

use App\Entity\MODELE;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ModeleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('modele_vehic', TextType::class, ['label' => 'Nom du modèle'])
            ->add('marque', ChoiceType::class, [
                'label' => 'Marque',
                'choices' => [
                    'Citroën' => 'Citroën',
                    'Ford' => 'Ford',
                    'Renault' => 'Renault',
                    'Peugeot' => 'Peugeot',
                    'Volkswagen' => 'Volkswagen',
                    'Toyota' => 'Toyota',
                ],
            ])
            ->add('annee', ChoiceType::class, [
                'label' => 'Année',
                'choices' => array_combine(
                    range(date('Y'), 2000, -1),
                    range(date('Y'), 2000, -1)
                ),
            ])
            ->add('date_achat', DateType::class, [
                'label' => 'Date d\'achat',
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MODELE::class,
        ]);
    }
}
