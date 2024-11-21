<?php

namespace App\Controller;

use App\Entity\Colab;
use App\Form\ColabType;
use App\Repository\ColabRepository;
use App\Repository\DossierRepository;
use App\Repository\AudienceRepository;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted; 
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ColabController extends AbstractController
{
    /**
     * @Route("/colab/", name="app_colab_index", methods={"GET"})
     */
    public function index(ColabRepository $colabRepository): Response
    {
        return $this->render('colab/index.html.twig', [
            'colabs' => $colabRepository->findAll(),
        ]);
    }

    /**
     * @Route("/colab/new", name="app_colab_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ColabRepository $colabRepository): Response
    {
        $colab = new Colab();
        $form = $this->createForm(ColabType::class, $colab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colabRepository->add($colab, true);
            return $this->redirectToRoute('app_colab_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colab/new.html.twig', [
            'colab' => $colab,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/colab/{id<\d+>}", name="app_colab_show", methods={"GET"})
     */
    public function show(Colab $colab = null, int $id): Response
    {

        dump($id); // Pour afficher l'ID dans la console de débogage

        $id = $colab->getId();

        return $this->render('colab/show.html.twig', [
            'colab' => $colab,
        ]);
    }

    /**
     * @Route("/colab/{id}/edit", name="app_colab_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Colab $colab, ColabRepository $colabRepository): Response
    {
        $form = $this->createForm(ColabType::class, $colab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $colabRepository->add($colab, true);
            return $this->redirectToRoute('app_colab_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('colab/edit.html.twig', [
            'colab' => $colab,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/colab/{id}", name="app_colab_delete", methods={"POST"})
     */
    public function delete(Request $request, Colab $colab, ColabRepository $colabRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$colab->getId(), $request->request->get('_token'))) {
            $colabRepository->remove($colab, true);
        }

        return $this->redirectToRoute('app_colab_index', [], Response::HTTP_SEE_OTHER);
    }

    
    /**
     * @Route("/colab/dashboard", name="app_colab_dashboard", methods={"GET","POST"})
     */

    public function dashboard(ColabRepository $colabRepository,ClientRepository $clientRepository,DossierRepository $dossierRepository,AudienceRepository $audienceRepository): Response
    {

        
        $colab = $this->getUser();
     
         
     
        $nombreClients = $clientRepository->count([]); // En supposant que 'isActive' filtre les clients actifs
        $nombreDossiers = $dossierRepository->count([]);
        $nombreAudiences = $audienceRepository->count([]); // Filtrons les audiences à venir

    return $this->render('colab/colab_dashboard.html.twig', [
        'colab' => $colab,
        'nombreClients' => $nombreClients,
        'nombreDossiers' => $nombreDossiers,
        'nombreAudiences' => $nombreAudiences,
    ]);
    }

     
}
