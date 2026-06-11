<?php

namespace App\Form;

use App\Entity\CALENDRIER;
use App\Entity\ELEVE;
use App\Entity\LECON;
use App\Entity\MODELE;
use App\Entity\MONITEUR;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LeconType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lecon_moniteur_id', EntityType::class, [
                'class' => MONITEUR::class,
                'choice_label' => 'nom_moniteur',
                'label' => 'Moniteur',
                'query_builder' => function($repo) {
                    return $repo->createQueryBuilder('m')
                        ->where('m.activite = true');
                },
            ])
            ->add('lecon_eleve_id', EntityType::class, [
                'class' => ELEVE::class,
                'choice_label' => 'nom_eleve',
                'label' => 'Élève',
            ])
            ->add('lecon_modele_vehic', EntityType::class, [
                'class' => MODELE::class,
                'choice_label' => 'modele_vehic',
                'label' => 'Véhicule',
                'query_builder' => function($repo) {
                    return $repo->createQueryBuilder('m')
                        ->join('App\Entity\VEHICULE', 'v', 'WITH', 'v.modele_vehic = m.modele_vehic')
                        ->where('v.etat = true');
                },
            ])
            ->add('lecon_date_heure', EntityType::class, [
                'class' => CALENDRIER::class,
                'choice_label' => function($calendrier) {
                    return $calendrier->getDateHeure()->format('d/m/Y H:i');
                },
                'label' => 'Horaire',
            ])
            ->add('duree', ChoiceType::class, [
                'label' => 'Durée',
                'choices' => [
                    '30 minutes' => 30,
                    '60 minutes' => 60,
                    '90 minutes' => 90,
                    '120 minutes' => 120,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LECON::class,
        ]);
    }
}
