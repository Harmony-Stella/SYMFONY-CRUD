<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/', name: 'app_tab')]
    public function index(): Response
    {
        $tableau = [
            [
                'id' => 1,
                'nom' => 'Bic',
                'couleur' => 'Rouge'
            ],
            [
                'id' => 2,
                'nom' => 'Ardoise',
                'couleur' => 'Noire'
            ],
            [
                'id' => 3,
                'nom' => 'Gourde',
                'couleur' => 'Bleue'
            ]
        ];
        return $this->render('tab/tableau.html.twig', [
            'tableau' => $tableau,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function supprimer(int $id): Response
    {
        // Supprimer l'élément du tableau associatif en fonction de l'ID
        unset($this->tableau[$id]);

        // Afficher la vue de modification avec l'élément récupéré
                return $this->render('tab/supprimer.html.twig', [
                    'id' => $id,
            ]);
    
        // Rediriger vers la page d'accueil
        return $this->redirectToRoute('app_tab');
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function modifier(int $id): Response
    {
        // Récupérer l'élément du tableau associatif en fonction de l'ID
        $element = $this->tableau[$id];

        // Afficher la vue de modification avec l'élément récupéré
        return $this->render('tab/modifier.html.twig', [
            'id' => $id,
            'element' => $element
    ]);
}

}