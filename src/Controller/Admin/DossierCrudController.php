<?php

namespace App\Controller\Admin;

use App\Entity\Dossier;
use App\Entity\Procedure;
use App\Form\ConclusionType;
use App\Form\ProcedureType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class DossierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Dossier::class;
    }

    // Modification de la signature pour être compatible avec celle du parent
  

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('numero'),
            AssociationField::new('client'),  // Association avec le client
            CollectionField::new('conclusions')

                ->setLabel('Conclusion')
                ->setEntryType(ConclusionType::class) 
                ->allowAdd(true)  
                ->allowDelete(true) 
                ->setSortable(true),   

            // Association des procédures avec un champ permettant d'ajouter des procédures
            CollectionField::new('procedures', 'Procedure')
                ->setLabel('Procedure')
                ->setEntryType(ProcedureType::class) // Utilisation du formulaire RenvoiType pour chaque entrée
                ->allowAdd(true)  // Permet d'ajouter dynamiquement des renvois
                ->allowDelete(true) // Permet de supprimer des renvois
                ->setSortable(true),  

            
        ];
    }
}
