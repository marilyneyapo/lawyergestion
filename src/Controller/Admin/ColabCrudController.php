<?php

namespace App\Controller\Admin;

use App\Entity\Colab;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class ColabCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Colab::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('tel'),
            TextField::new('cel'),
            EmailField::new('email'),
            TextField::new('password')->onlyOnForms(),
            TextField::new('typecolab'),






            
        ];
    }
    
}
