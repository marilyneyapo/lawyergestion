<?php

namespace App\Controller\Admin;

use App\Entity\Adversaire;
use App\Entity\Audience;
use App\Entity\Cabinet;
use App\Entity\Chambre;
use App\Entity\Client;
use App\Entity\Colab;
use App\Entity\Dossier;
use App\Entity\Juridiction;
use App\Entity\Services;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    
    
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Office');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('My Office Dashboard', 'fa fa-tachometer-alt');
    
        yield MenuItem::section('Gestions', 'fa fa-cogs');
    
        yield MenuItem::linkToCrud('Clients', 'fa fa-user-tie', Client::class)
            ->setController(ClientCrudController::class);
    
            yield MenuItem::subMenu('Audiences', 'fa fa-calendar-check')
            ->setSubItems([
                MenuItem::linkToCrud('Voir Audiences', 'fa fa-eye', Audience::class)
                    ->setController(AudienceCrudController::class),
                MenuItem::linkToRoute('Télécharger Planning', 'fa fa-download', 'admin_download_planning'),
                MenuItem::linkToRoute('Sans Résultats', 'fa fa-search', 'admin_audience_without_results'),
                MenuItem::linkToRoute('Historiques Juridiques', 'fa fa-search', 'admin_audience_without_results'),

            ]);
    
        yield MenuItem::linkToCrud('Dossiers', 'fa fa-folder-open', Dossier::class)
            ->setController(DossierCrudController::class);
    
        yield MenuItem::linkToCrud('Collaborateurs', 'fa fa-users-cog', Colab::class)
            ->setController(ColabCrudController::class);
    
        yield MenuItem::linkToCrud('Services Juridiques', 'fa fa-balance-scale', Services::class)
            ->setController(ServicesCrudController::class);
    
        yield MenuItem::linkToCrud('Adversaires', 'fa fa-user-shield', Adversaire::class)
            ->setController(AdversaireCrudController::class);
    
        yield MenuItem::linkToCrud('Juridictions', 'fa fa-gavel', Juridiction::class)
            ->setController(JuridictionCrudController::class);
    
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user-cog', User::class)
            ->setController(UserCrudController::class);
    
        yield MenuItem::linkToCrud('Chambres', 'fa fa-door-closed', Chambre::class)
            ->setController(ChambreCrudController::class);
    }
    
}
