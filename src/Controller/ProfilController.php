<?php

namespace App\Controller;

use App\Entity\Demandeur;
use App\Form\DiplomesType;
use App\Form\ExperiencesType;
use App\Form\CompetencesType;
use App\Form\SearchedJobType;
use App\Form\IsActifType;
use App\Form\PersonnelleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $formDiplomes = $this->createForm(DiplomesType::class, $user);
        $formExperiences = $this->createForm(ExperiencesType::class, $user);
        $formCompetences = $this->createForm(CompetencesType::class, $user);
        $formJobDetails = $this->createForm(SearchedJobType::class, $user);
        $formIsActif = $this->createForm(IsActifType::class, $user);
        $formPersonnelle = $this->createForm(PersonnelleType::class, $user);

        $formDiplomes->handleRequest($request);
        $formExperiences->handleRequest($request);
        $formCompetences->handleRequest($request);
        $formJobDetails->handleRequest($request);
        $formIsActif->handleRequest($request);
        $formPersonnelle->handleRequest($request);

        if ($formDiplomes->isSubmitted() && $formDiplomes->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Vos diplômes ont été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        if ($formExperiences->isSubmitted() && $formExperiences->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Vos expériences ont été mises à jour.');
            return $this->redirectToRoute('app_profil');
        }

        if ($formCompetences->isSubmitted() && $formCompetences->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Vos compétences ont été mises à jour.');
            return $this->redirectToRoute('app_profil');
        }

        if ($formJobDetails->isSubmitted() && $formJobDetails->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Les détails de votre poste ont été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        if ($formIsActif->isSubmitted() && $formIsActif->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Le statut actif a été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }
        if ($formPersonnelle->isSubmitted() && $formPersonnelle->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Le statut actif a été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/profil.html.twig', [
            'formDiplomes' => $formDiplomes->createView(),
            'formExperiences' => $formExperiences->createView(),
            'formCompetences' => $formCompetences->createView(),
            'formJobDetails' => $formJobDetails->createView(),
            'formPersonnelle' => $formPersonnelle->createView(),
            'formIsActif' => $formIsActif->createView(), // Ajouter le formulaire à la vue
        ]);
    }
}