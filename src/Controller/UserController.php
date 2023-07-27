<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Forms\UserUpsertType;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user_homapage')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/add_user', name: 'user_insert')]
    public function userInsert(
        Request $request,
        EntityManagerInterface $entityManager,
    ): Response
    {
        $form = $this->createForm(UserUpsertType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $entityManager->persist($user);
            //$entityManager->flush();            
            
            $this->addFlash('success', 'User added successfully.');
            return $this->redirectToRoute('user_insert');
        }
        return $this->render('user/upsert.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}