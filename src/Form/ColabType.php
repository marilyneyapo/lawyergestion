<?php

namespace App\Form;

use App\Entity\Colab;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ColabType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Nom')
            ->add('Prenom')
            ->add('Tel')
            ->add('Cel')
            ->add('Email')
            ->add('Typecolab')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colab::class,
        ]);
    }
}
