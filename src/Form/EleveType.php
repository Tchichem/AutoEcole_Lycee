<?php

namespace App\Form;

use App\Entity\ELEVE;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EleveType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_eleve', TextType::class, ['label' => 'Nom'])
            ->add('prenom_eleve', TextType::class, ['label' => 'Prénom'])
            ->add('date_naissance_eleve', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
            ])
            ->add('code', CheckboxType::class, [
                'label' => 'Code',
                'required' => false,
            ])
            ->add('conduite', CheckboxType::class, [
                'label' => 'Conduite',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ELEVE::class,
        ]);
    }
}
