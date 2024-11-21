<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Colab;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
      
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'required' => true,
        ])
        ->add('pass', PasswordType::class, [
            'label' => 'Password',
            'required' => true,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colab::class,
        ]);
    }
}
