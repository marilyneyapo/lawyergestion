<?php

namespace App\Form;

use App\Entity\Adversaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;

class AdversaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => false,
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Saisissez le nom de ladversaire ',
                ]
            ])
            ->add('prenom', TextType::class, [
                'required' => false,
                'label' => 'Prenom',
                'attr' => [
                    'placeholder' => 'Saisissez le prenom de ladversaire',
                ],
                

            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adversaire::class,
        ]);
    }
}
