<?php

namespace App\Controller;
use App\Entity\Dossier;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DossierController extends AbstractController
{
    /**
     * @Route("/dossier", name="app_dossier")
     */
    public function index(DossierRepository $dossierRepository): Response
    {
        // Récupérer tous les dossiers, triés par avocat et par client (ordre alphabétique)
        $dossiers = $dossierRepository->findBy([], ['client' => 'ASC']);

        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossiers,
        ]);
    }

    /**
     * @Route("/dossier/{id}", name="app_dossier_show",methods={"GET"})
     */
    public function show(DossierRepository $dossierRepository,int $id): Response
    {
        $dossier = $dossierRepository->findOneBy(['id' => $id]);

        return $this->render('dossier/show.html.twig', [
            'dossier' => $dossier,
        ]);
    }
}
