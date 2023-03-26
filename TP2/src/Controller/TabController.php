<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
   
    private $tableau;

    public function __construct() {
        $this->tableau = [
            1 => ['nom' => 'John', 'age' => 30],
            2 => ['nom' => 'Jane', 'age' => 25],
            3 => ['nom' => 'Bob', 'age' => 40],
        ];
    }

    #[Route('/', name: 'app_tab')]
    public function index(): Response
    {
        return $this->render('tab/tableau.html.twig', [
            'tableau' => $this->tableau,
        ]);
    }

    #[Route('/supprimer/{id}', name: 'supprimer')]
    public function supprimer(int $id): Response
    {
        // Supprimer l'élément du tableau associatif en fonction de l'ID
        unset($this->tableau[$id]);        
        // Rediriger vers la page d'accueil
        return $this->redirectToRoute('app_tab', ['tableau'=>$this->tableau]);
    }

    #[Route('/modifier/{id}', name: 'modifier')]
    public function modifier(int $id): Response
    {
        // Récupérer l'élément du tableau associatif en fonction de l'ID
        // Afficher la vue de modification avec l'élément récupéré
        return $this->render('tab/modifier.html.twig', [
            
    ]);
}

}