<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /*Fonction de recuperation de toutes les films*/
    #[Route('/', name: 'app_films')]
    public function films(FilmRepository $filmRepository){
        $films = $filmRepository->findAll();
        return $this->render('film/listesFilms.html.twig',array(
            'films'=>$films
        ));
    }

        /*Ajout de transasction*/
        #[Route('/ajout', name: 'app_ajout_film')]
        public function ajoutFilm(Request $request, EntityManagerInterface $em)
        {
            $film = new Film();
            $form = $this->createForm(FilmType::class, $film);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){ 
                $em ->persist($film);
                $em ->flush();
                return $this->redirectToRoute('app_films');
        }
        return $this->render('film/ajoutFilm.html.twig',array(
            'form'=>$form->createView()
        ));
        }

        
            /*Modificatrion de film*/
    #[Route('/modifier/{id<\d+>}', name: 'app_modifier_film')]
    public function modifierFilm(Request $request, Film $film, EntityManagerInterface $em)
    {
        $form = $this->createForm(FilmType::class, $film);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em ->flush();
            return $this->redirectToRoute('app_films');
    }
    return $this->render('film/modifierFilm.html.twig',array(
        'form'=>$form->createView()
    ));
    }

        /*Suppression de la film*/
        #[Route('/supprimer/{id<\d+>}', name: 'app_supprimer_film')]
        public function supprimerFilm(Film $film, EntityManagerInterface $em)
        {
            $em ->remove($film);
            $em ->flush();
            return $this->redirectToRoute('app_films'); 
    
        }

    /*Recherhe à parrtir du titre d'un film */
    

}
