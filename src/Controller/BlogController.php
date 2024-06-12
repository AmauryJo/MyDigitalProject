<?php

namespace App\Controller;

use App\Repository\DemandeurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function blog(): Response
    {
        // $demandeurs = $demandeurRepository->findAll();
        // $demandeur = $demandeurRepository->findOneById(1);
        // return $this->render('home/home.html.twig',[
        //     'demandeur' => $demandeur,
        // ]);

        return $this->render('blog/blog.html.twig', [
        ]);
    }
}