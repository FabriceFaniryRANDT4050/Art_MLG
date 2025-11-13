<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class EmployeController extends AbstractController
{
    #[Route('/api/employes', name: 'api_employes', methods: ['GET'])]
    public function index(): JsonResponse
    {
        // Exemple de données, tu peux remplacer par ta base de données avec Doctrine
        $employes = [
            ['id' => 1, 'nom' => 'Dupont', 'poste' => 'Développeur'],
            ['id' => 2, 'nom' => 'Martin', 'poste' => 'Designer'],
        ];

        return $this->json($employes);
    }
}
