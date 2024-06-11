<?php

namespace App\Controller;

use App\Repository\DemandeurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
        // $demandeurs = $demandeurRepository->findAll();
        // $demandeur = $demandeurRepository->findOneById(1);
        // return $this->render('home/home.html.twig',[
        //     'demandeur' => $demandeur,
        // ]);

        return $this->render('home/home.html.twig', [
        ]);
    }
}