<?php

namespace App\Controller\Admin;

use App\Entity\Chambre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;


class ChambreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Chambre::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            AssociationField::new('juridiction'),
            TextField::new('nom'),
            TextField::new('president'),
            CollectionField::new('greffiers')
            ->allowAdd()
            ->allowDelete()
            ->setFormTypeOptions([
                'entry_type' => \Symfony\Component\Form\Extension\Core\Type\TextType::class,
                'entry_options' => ['label' => false],
            ]),

        ];
    }
    
}
