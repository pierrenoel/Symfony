<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/', name: 'user')]
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
    public function create() : response
    {

        $user = new User();
        $user->setFirstname('Pierre');
        $user->setLastname('Noël');

        $this->entityManager()->persist($user);

        $this->entityManager()->flush();

        return $this->redirect('/');
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
