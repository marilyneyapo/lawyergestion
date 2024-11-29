<?php

namespace App\Controller\Admin;

use App\Entity\Conclusion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConclusionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conclusion::class;
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
