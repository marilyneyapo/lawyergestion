<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code',TextType::class)
            ->add('raisonso',TextType::class)
            ->add('contact',TextType::class)
            ->add('titre',TextType::class)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('tel',TextType::class)
            ->add('cel',TextType::class)
            ->add('email',TextType::class)
            ->add('fax',TextType::class)
            ->add('profil',TextType::class)
            ->add('pass',TextType::class)
            ->add('role',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
