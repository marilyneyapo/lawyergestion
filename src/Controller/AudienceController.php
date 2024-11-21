<?php

namespace App\Controller;

use App\Repository\AudienceRepository;
use App\Entity\Audience;
use App\Form\AudienceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class AudienceController extends AbstractController
{
    /**
     * @Route("/audience", name="app_audience")
     */
    public function index(AudienceRepository $audienceRepository): Response
    {
        // Récupérer toutes les audiences triées par date
        $audiences = $audienceRepository->findAllOrderedByDate();

        return $this->render('audience/index.html.twig', [
            'audiences' => $audiences,
        ]);
    }

    /**
     * @Route("/audience/new", name="audience_new")
     */
    
     
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $audience = new Audience();
        $form = $this->createForm(AudienceType::class, $audience);
     
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $entityManager->persist($audience);
            $entityManager->flush();
     
            $this->addFlash('success', 'Audience created successfully!');

     
            return $this->redirectToRoute('app_audience'); 
        }
    
        return $this->render('audience/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/audience/{id}/download", name="audience_download")
     */
    public function download(int $id, AudienceRepository $audienceRepository): Response
    {
        $audience = $audienceRepository->find($id);
        if (!$audience) {
            throw $this->createNotFoundException('L\'audience demandée n\'existe pas.');
        }

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        // Retrieve the HTML generated in our Twig file
        $html = $this->renderView('audience/pdf.html.twig', [
            'audience' => $audience
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        return new Response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="audience_' . $audience->getId() . '.pdf"'
        ]);
    }
     
}
