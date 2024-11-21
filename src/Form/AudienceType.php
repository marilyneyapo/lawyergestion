<?php 

namespace App\Form;

use App\Entity\Audience;
use App\Entity\Client;
use App\Entity\Colab;
use App\Entity\Dossier;
use App\Entity\Adversaire;
use App\Entity\Juridi;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AudienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', TextType::class, [
                'label' => 'Numéro',
            ])
            ->add('date', DateTimeType::class, [
                'label' => 'Date',
                'widget' => 'single_text', 
            ])
            ->add('conseil', TextType::class, [
                'label' => 'Conseil',
            ])
            ->add('greffier', TextType::class, [
                'label' => 'Greffier',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Audience::class,
        ]);
    }
}
