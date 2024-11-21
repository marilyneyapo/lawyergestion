<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('titre'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('tel'),
            TextField::new('cel'),
            EmailField::new('email'),
            TextField::new('password')->onlyOnForms(),
            ChoiceField::new('roles')
                ->setChoices([
                    'Client' => 'ROLE_USER', 
                    'Administrateur' => 'ROLE_ADMIN',
                    'Collaborateur' => 'ROLE_COLLABORATOR'
                ])
                ->allowMultipleChoices(true)
                ->renderExpanded()
                ->setHelp('Choisissez les rôles pour cet utilisateur.')
        ];
    }
    
}
