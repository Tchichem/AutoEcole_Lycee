<?php

namespace App\Form;

use App\Entity\MONITEUR;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoniteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_moniteur')
            ->add('prenom_moniteur')
            ->add('date_naissance_moniteur')
            ->add('date_embauche')
            ->add('activite')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MONITEUR::class,
        ]);
    }
}
