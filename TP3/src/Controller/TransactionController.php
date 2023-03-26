<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\TransactionType;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TransactionController extends AbstractController
{

    /*Fonction de recuperation de toutes les transactions*/
    #[Route('/', name: 'app_transactions')]
    public function transactions(TransactionRepository $transactionRepository){
        $transactions = $transactionRepository->findAll();
        return $this->render('transaction/listesTransactions.html.twig',array(
            'transactions'=>$transactions
        ));
    }

    /*Ajout de transasction*/
    #[Route('/ajout', name: 'app_ajout_transaction')]
    public function ajoutTransaction(Request $request, EntityManagerInterface $em)
    {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ 
            $em ->persist($transaction);
            $em ->flush();
            return $this->redirectToRoute('app_transactions');
    }
    return $this->render('transaction/ajoutTransaction.html.twig',array(
        'form'=>$form->createView()
    ));
    }

    /*Modificatrion de transaction*/
    #[Route('/modifier/{id<\d+>}', name: 'app_modifier_transaction')]
    public function modifierTransaction(Request $request, Transaction $transaction, EntityManagerInterface $em)
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em ->flush();
            return $this->redirectToRoute('app_transactions');
    }
    return $this->render('transaction/modifierTransaction.html.twig',array(
        'form'=>$form->createView()
    ));
    }

    /*Suppression de la transaction*/
    #[Route('/supprimer/{id<\d+>}', name: 'app_supprimer_transaction')]
    public function supprimerLivre(Transaction $transaction, EntityManagerInterface $em)
    {
        $em ->remove($transaction);
        $em ->flush();
        return $this->redirectToRoute('app_transactions'); 

    }
}
