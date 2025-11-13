<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ModePaiementController extends AbstractController
{
    #[Route('/mode/paiement', name: 'app_mode_paiement')]
    public function index(): Response
    {
        return $this->render('mode_paiement/index.html.twig', [
            'controller_name' => 'ModePaiementController',
        ]);
    }
}
