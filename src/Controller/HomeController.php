<?php

namespace App\Controller;

use App\Entity\OffreEmploi;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(EntityManagerInterface $entityManager): Response
    {
        $offresEmploi = $entityManager->getRepository(OffreEmploi::class)->findAll();

        return $this->render('home/home.html.twig', [
            'offresEmploi' => $offresEmploi,
        ]);
    }
}