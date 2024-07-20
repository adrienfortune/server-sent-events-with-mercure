<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Attribute\Route;

class PublishController extends AbstractController
{
    #[Route('/publish', name: 'app_publish')]
    public function publish(HubInterface $hub): Response
    {

        $newMessage = 'nouveau commentaire '.rand(1, 100);

        $update = new Update(
            'https://example.com/books/1',
            json_encode(['message' => $newMessage])
        );

        $hub->publish($update);

        return new Response('Nouveau message publié : '. $newMessage);
    }

    #[Route('/subscribe', name: 'app_subscribe')]
    public function subscribe(): Response
    {
        return $this->render('publish/index.html.twig', [
            'controller_name' => 'PublishController',
        ]);
    }
}
