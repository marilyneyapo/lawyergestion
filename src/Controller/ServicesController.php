<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/serjuridik")
 */
class ServicesController extends AbstractController
{
    /**
     * @Route("/", name="app_serjuridik_index", methods={"GET"})
     */
    public function index(ServicesRepository $serjuridikRepository): Response
    {
        return $this->render('serjuridik/index.html.twig', [
            'serjuridiks' => $serjuridikRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_serjuridik_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ServicesRepository $serjuridikRepository): Response
    {
        $serjuridik = new Services();
        $form = $this->createForm(ServicesType::class, $serjuridik);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serjuridikRepository->add($serjuridik, true);

            return $this->redirectToRoute('app_serjuridik_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('serjuridik/new.html.twig', [
            'serjuridik' => $serjuridik,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_serjuridik_show", methods={"GET"})
     */
    public function show(Services $services): Response
    {
        return $this->render('serjuridik/show.html.twig', [
            'serjuridik' => $services,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_serjuridik_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Services $services, ServicesRepository $serjuridikRepository): Response
    {
        $form = $this->createForm(ServicesType::class, $services);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serjuridikRepository->add($services, true);

            return $this->redirectToRoute('app_serjuridik_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('serjuridik/edit.html.twig', [
            'serjuridik' => $services,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_serjuridik_delete", methods={"POST"})
     */
    public function delete(Request $request, Services $services, ServicesRepository $serjuridikRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$services->getId(), $request->request->get('_token'))) {
            $serjuridikRepository->remove($services, true);
        }

        return $this->redirectToRoute('app_serjuridik_index', [], Response::HTTP_SEE_OTHER);
    }
}
