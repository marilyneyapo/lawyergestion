<?php

namespace App\Controller\Admin;

use App\Entity\Audience;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use Dompdf\Options;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Form\RenvoiType;


use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use App\Repository\ClientRepository;
use App\Repository\DossierRepository;
use App\Repository\AudienceRepository;




class AudienceCrudController extends AbstractCrudController
{
    private $validator;
    private $flashBag;
    private $entityManager;



    public function __construct(ValidatorInterface $validator, FlashBagInterface $flashBag)
    {
        $this->validator = $validator;
        $this->flashBag = $flashBag;

    }

    public static function getEntityFqcn(): string
    {
        return Audience::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        $downloadPlanningAction = Action::new('downloadPlanning', 'Télécharger Planning', 'fa fa-download')
            ->linkToRoute('admin_download_planning'); // Define the route for download action

        return $actions
            ->add(Crud::PAGE_INDEX, $downloadPlanningAction)
            ->add(Crud::PAGE_INDEX, Action::new('showWithoutResults', 'Sans Résultats')
                ->linkToRoute('admin_audience_without_results')  // Lier l'action à la route showWithoutResults

        );
            
    }

    
    
   

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            DateField::new('date')->setLabel('Date de l\'Audience')->setSortable(true), // Trié par date
            TextField::new('conseil')->setLabel('Conseil'),
            TextField::new('motif')
                ->setLabel('Motif')
                ->setRequired(false), 
            CollectionField::new('renvois', 'Renvois')
                ->setLabel('Renvois')
                ->setEntryType(RenvoiType::class) // Utilisation du formulaire RenvoiType pour chaque entrée
                ->allowAdd(true)  // Permet d'ajouter dynamiquement des renvois
                ->allowDelete(true) // Permet de supprimer des renvois
                ->setSortable(true),  // Vous ne pouvez pas trier une collection directement, vous devez peut-être trier via un champ dans Renvoi
                     
            // Association avec la juridiction
            AssociationField::new('juridiction')
                ->setLabel('Juridiction')
                ->setFormTypeOption('query_builder', function ($er) {
                    return $er->createQueryBuilder('j')
                        ->orderBy('j.Titre', 'ASC');
                }),

            // Association avec la chambre, filtrée par la juridiction sélectionnée
            AssociationField::new('chambre')
                ->setLabel('Chambre')
                ->setFormTypeOption('placeholder', 'Sélectionnez une chambre'),

            AssociationField::new('adversaire')->setLabel('Adversaire'),
            AssociationField::new('dossier')->setLabel('Dossier (Client)')
                ->setFormattedValue(function ($value) {
                    return $value ? $value->getClient()->getNom() : 'Client non disponible';
                }),
        ];
    }

    

    public function persistEntity(EntityManagerInterface $entityManager, $entity): void
    {
        // Validation de l'entité
        $errors = $this->validator->validate($entity);

        if (count($errors) > 0) {
            // Si des erreurs de validation sont présentes
            foreach ($errors as $error) {
                // Ajouter un message flash pour chaque erreur
                $this->flashBag->add('danger', $error->getMessage());
            }
            $this->addFlash('danger', 'Des erreurs de validation sont présentes. Merci de les corriger.');

        } else {
            // Si l'entité est valide, persistez-la normalement
            parent::persistEntity($entityManager, $entity);
            $this->addFlash('success', 'L\'audience a été mise à jour avec succès.');

        }
    }


    public function updateEntity(EntityManagerInterface $entityManager, $entity): void
    {
        // Validation de l'entité
        $errors = $this->validator->validate($entity);

        if (count($errors) > 0) {
            // Si des erreurs de validation sont présentes
            foreach ($errors as $error) {
                // Ajouter un message flash pour chaque erreur
                $this->flashBag->add('danger', $error->getMessage());
            }
            $this->addFlash('danger', 'Des erreurs de validation sont présentes. Merci de les corriger.');

        } else {
            // Si l'entité est valide, effectuez la mise à jour
            parent::updateEntity($entityManager, $entity);
            $this->addFlash('success', 'L\'audience a été mise à jour avec succès.');
        }
    }

   // Ajout d'une nouvelle méthode pour télécharger toutes les audiences
    /**
     * @Route("/admin/audience/download-planning", name="admin_download_planning")
     */
    public function downloadAll(EntityManagerInterface $entityManager): Response
    {
        // Récupérer toutes les audiences
        $audiences = $entityManager->getRepository(Audience::class)->findAll();

        // Configure Dompdf selon vos besoins
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instancier Dompdf avec les options définies
        $dompdf = new Dompdf($pdfOptions);

        // Générer l'HTML à partir du template Twig
        $html = $this->renderView('audience/planning_all.html.twig', [
            'audiences' => $audiences
        ]);

        // Charger l'HTML dans Dompdf
        $dompdf->loadHtml($html);

        // Configurer la taille et l'orientation du papier (si nécessaire)
        $dompdf->setPaper('A4', 'portrait');

        // Rendre l'HTML en PDF
        $dompdf->render();

        // Retourner la réponse avec le PDF généré
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="audiences.pdf"'
        ]);
    }

    /**
     * @Route("/admin/audience/sans_resultats", name="admin_audience_without_results")
     */

     public function showWithoutResults(): Response
     {
         // Generate the admin URL with filters for 'motif' and 'renvoi.dateRenvoi' being null
         $url = $this->get(AdminUrlGenerator::class)
             ->setController(self::class)
             ->setAction('index')
             ->set('filters', [
                 // Filter audiences where motif is null
                 'motif' => ['value' => null],
                 // Filter audiences where renvoi dateRenvoi is null
                 'Renvoi.dateRenvoi' => ['value' => null],
             ])
             ->generateUrl();
     
         // Redirect to the generated URL with the filters
         return $this->redirect($url);
     }
     

     /*
     * @Route("/admin/historique-juridique/client", name= "historique_juridique")
     */
    public function rechercherHistorique(
        Request $request,
        ClientRepository $clientRepository,
        AudienceRepository $audienceRepository
    ): Response {
        $searchTerm = $request->query->get('search'); // Récupère le terme de recherche
        $client = null;
        $audiences = [];

        if ($searchTerm) {
            // Rechercher par nom de client
            $client = $clientRepository->findOneBy(['nom' => $searchTerm]);

            if ($client) {
                // Récupérer les audiences liées au client
                $audiences = $audienceRepository->findBy(['dossier.client' => $client->getId()]);
            } else {
                // Rechercher par numéro de dossier
                $audiences = $audienceRepository->createQueryBuilder('a')
                    ->join('a.dossier', 'd')
                    ->where('d.reference = :reference')
                    ->setParameter('reference', $searchTerm)
                    ->getQuery()
                    ->getResult();
            }
        }

        return $this->render('audience/historique_juridique.html.twig', [
            'searchTerm' => $searchTerm,
            'client' => $client,
            'audiences' => $audiences,
        ]);
    }

        
}
