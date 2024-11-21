<?php

namespace App\Controller;

use App\Entity\Cabinet;
use App\Form\CabinetType;
use App\Repository\CabinetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cabinet")
 */
class CabinetController extends AbstractController
{
    /**
     * @Route("/", name="app_cabinet_index", methods={"GET"})
     */
    public function index(CabinetRepository $cabinetRepository): Response
    {
        return $this->render('cabinet/index.html.twig', [
            'cabinets' => $cabinetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cabinet_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CabinetRepository $cabinetRepository): Response
    {
        $cabinet = new Cabinet();
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cabinetRepository->add($cabinet, true);

            return $this->redirectToRoute('app_cabinet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cabinet/new.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cabinet_show", methods={"GET"})
     */
    public function show(Cabinet $cabinet): Response
    {
        return $this->render('cabinet/show.html.twig', [
            'cabinet' => $cabinet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cabinet_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cabinet $cabinet, CabinetRepository $cabinetRepository): Response
    {
        $form = $this->createForm(CabinetType::class, $cabinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cabinetRepository->add($cabinet, true);

            return $this->redirectToRoute('app_cabinet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cabinet/edit.html.twig', [
            'cabinet' => $cabinet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cabinet_delete", methods={"POST"})
     */
    public function delete(Request $request, Cabinet $cabinet, CabinetRepository $cabinetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cabinet->getId(), $request->request->get('_token'))) {
            $cabinetRepository->remove($cabinet, true);
        }

        return $this->redirectToRoute('app_cabinet_index', [], Response::HTTP_SEE_OTHER);
    }
}
