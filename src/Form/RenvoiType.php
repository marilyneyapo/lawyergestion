<?php

namespace App\Form;

use App\Entity\Renvoi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RenvoiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateRenvoi', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de Renvoi',
            ])
            ->add('motif', TextType::class, [
                'label' => 'Motif',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Renvoi::class, // Pas d'entité spécifique pour ce formulaire
        ]);
    }
}
