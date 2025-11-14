<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PaimenentController extends AbstractController
{
    #[Route('/paimenent', name: 'app_paimenent')]
    public function index(): Response
    {
        return $this->render('paimenent/index.html.twig', [
            'controller_name' => 'PaimenentController',
        ]);
    }
}
