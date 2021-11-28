<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /** @IsGranted("ROLE_USER") */
    #[Route('/category/create',name:'app-category-create',methods:'GET')]
    public function create()
    {
        return $this->render('category/create.html.twig');
    }

    /** @IsGranted("ROLE_USER") */
    #[Route('/category/create',name:'app-category-store', methods:'POST')]
    public function store(Request $request) : response
    {
        $entityManager = $this->getDoctory->getManager();

        $category = new Category();
        $category->setName($request->get('name'));
        $category->setSlug()
    }
}
