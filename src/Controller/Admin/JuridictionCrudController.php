<?php

namespace App\Controller\Admin;

use App\Entity\Juridiction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class JuridictionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Juridiction::class;
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
