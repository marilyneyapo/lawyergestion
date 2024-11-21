<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Adversaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ButtonField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;


class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('titre'),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('code'),                   
            AssociationField::new('adversaire')
                ->setLabel('Adversaire')
                ->setFormTypeOptions([
                    'choice_label' => fn($adversaire) => $adversaire->getNom() . ' ' . $adversaire->getPrenom(),
                ])
                ->setCrudController(AdversaireCrudController::class), 
            TextField::new('adversaire.nom', 'Nom de l\'adversaire') // Champ pour créer un adversaire
                ->onlyWhenCreating()
                ->setFormTypeOptions([
                    'mapped' => false, // Empêche ce champ d'être lié directement à l'entité `Client`
                    'required' => false,
                ]),
            TextField::new('adversaire.prenom', 'Prénom de l\'adversaire')
                ->onlyWhenCreating()
                ->setFormTypeOptions([
                    'mapped' => false,
                    'required' => false,
                ]),
            IntegerField::new('tel'),
            IntegerField::new('cel'),
            EmailField::new('email'),
            TextField::new('raisonso'),
            TextField::new('fax'),
            TextField::new('password'),

            
        ];
    }


   

}
