<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security; 

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="app_client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }


    /**
     * @Route("/{id}", name="app_client_show", methods={"GET"})
     */
    public function show(ClientRepository $clientRepository, int $id): Response
    {
        
        $client = $clientRepository->find($id);

    if (!$client || !$client instanceof Client) {
        throw $this->createNotFoundException('Client not found.');
    }

    return $this->render('client/show.html.twig', [
        'client' => $client,
    ]);
    }

    
    

    
    
}
