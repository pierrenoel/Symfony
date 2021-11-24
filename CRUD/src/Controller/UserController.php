<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserCreateType;

class UserController extends AbstractController
{
    #[Route('/', name: 'users')]
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/user/show/{user}',name:'user-show')]
    public function show(User $user) : Response
    {
        return $this->render('user/show.html.twig',['user' => $user]);
    }

    #[Route('/user/create',name:'user-create')]
    public function create(Request $request) : Response
    {
        $user = new User();
        
        // Display the form
        $form = $this->createForm(UserCreateType::class,$user);
                
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $user = $form->getData();
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('users');
        }

        return $this->renderForm('user/create.html.twig',['form' => $form]);
    }

    #[Route('/user/delete/{user}',name:'user-delete')]
    public function delete(User $user) : Response
    {
        $this->entityManager()->remove($user);
        $this->entityManager()->flush();

        return $this->redirect('/');
    }

    private function entityManager()
    {
        return $this->getDoctrine()->getManager();
    }
}
