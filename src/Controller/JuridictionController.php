<?php

namespace App\Controller;

use App\Entity\Juridiction;
use App\Form\JuridictionType;
use App\Repository\JuridictionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/juridi")
 */
class JuridictionController extends AbstractController
{
    /**
     * @Route("/", name="app_juridi_index", methods={"GET"})
     */
    public function index(JuridictionRepository $juridictionRepository): Response
    {
        return $this->render('juridi/index.html.twig', [
            'juridis' => $juridictionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_juridi_new", methods={"GET", "POST"})
     */
    public function new(Request $request, JuridictionRepository $juridiRepository): Response
    {
        $juridi = new Juridiction();
        $form = $this->createForm(JuridictionType::class, $juridi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $juridiRepository->add($juridi, true);

            return $this->redirectToRoute('app_juridi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('juridi/new.html.twig', [
            'juridi' => $juridi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_juridi_show", methods={"GET"})
     */
    public function show(Juridiction $juridiction): Response
    {
        return $this->render('juridi/show.html.twig', [
            'juridi' => $juridiction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_juridi_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Juridiction $juridiction, JuridictionRepository $juridictionRepository): Response
    {
        $form = $this->createForm(JuridictionType::class, $juridiction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $juridictionRepository->add($juridiction, true);

            return $this->redirectToRoute('app_juridi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('juridi/edit.html.twig', [
            'juridi' => $juridiction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_juridi_delete", methods={"POST"})
     */
    public function delete(Request $request, Juridiction $juridiction, JuridictionRepository $juridictionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$juridiction->getId(), $request->request->get('_token'))) {
            $juridictionRepository->remove($juridiction, true);
        }

        return $this->redirectToRoute('app_juridi_index', [], Response::HTTP_SEE_OTHER);
    }
}
