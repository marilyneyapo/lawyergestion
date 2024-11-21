<?php

namespace App\EventListener;

use App\Entity\Client;
use App\Entity\Adversaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class ClientCreatedListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Cette méthode sera appelée après la réponse du contrôleur (après la création du client)
    public function onClientCreated(ResponseEvent $event)
    {
        // Récupérer la requête et la réponse
        $request = $event->getRequest();
        $response = $event->getResponse();

        // Vérifier si la requête est liée à l'action de création d'un client dans EasyAdmin
        if ($request->get('_route') === 'easyadmin') {
            // Vérifiez que le client est dans la session ou en tant que paramètre de la requête
            $client = $request->get('client'); // Exemple de récupération d'un client dans la requête

            if ($client instanceof Client) {
                // Créer un adversaire pour le client
                $adversaire = new Adversaire();
                $adversaire->setNom('Adversaire de ' . $client->getNom()); // Exemple de nom
                $adversaire->setClient($client); // Associer l'adversaire au client

                // Persister l'adversaire
                $this->entityManager->persist($adversaire);
                $this->entityManager->flush();
            }
        }
    }
}

