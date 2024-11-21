<?php

namespace App\Controller\Admin;

use App\Entity\Adversaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdversaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adversaire::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
