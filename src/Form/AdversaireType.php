<?php

namespace App\Form;

use App\Entity\Adversaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\TextType;
use Doctrine\ORM\EntityRepository;

class AdversaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adversaire', TextType::class, [
                'required' => false,
                'label' => 'Adversaire',
                'attr' => [
                    'placeholder' => 'Saisissez un adversaire ou choisissez dans la liste',
                ],
                'help' => 'Si l\'adversaire n\'existe pas, il sera créé automatiquement.',
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adversaire::class,
        ]);
    }
}
