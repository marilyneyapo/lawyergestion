<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Adversaire;
use App\Form\AdversaireType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
            CollectionField::new('adversaires')
                ->setLabel('Adversaire')
                ->setEntryType(AdversaireType::class) 
                ->allowAdd(true)  
                ->allowDelete(true) 
                ->setSortable(true),

            ChoiceField::new('roles_client', 'Rôles')
                ->setChoices([
                    'Demandeur' => 'demandeur',
                    'Tiers ' => 'tiers',
                    'Intime' => 'intime',
                ])
                ->allowMultipleChoices(false) // Si le client peut avoir un seul rôle
                ->setFormTypeOptions([
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
