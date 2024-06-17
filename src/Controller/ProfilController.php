<?php

namespace App\Controller;

use App\Repository\DemandeurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profil(): Response
    {
        // $demandeurs = $demandeurRepository->findAll();
        // $demandeur = $demandeurRepository->findOneById(1);
        // return $this->render('home/home.html.twig',[
        //     'demandeur' => $demandeur,
        // ]);

        return $this->render('profil/profil.html.twig', [
        ]);
    }
}