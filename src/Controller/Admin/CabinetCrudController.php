<?php

namespace App\Controller\Admin;

use App\Entity\Cabinet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CabinetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cabinet::class;
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
