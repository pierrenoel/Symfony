<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app-home')]
    public function index(): Response
    {
        // Get all the categories to the homepage
        $categories = $this->getDoctrine()->getRepository(Categories::class)->findAll();

        return $this->render('home/index.html.twig', [
            'categories' => $categories
        ]);
    }

}
