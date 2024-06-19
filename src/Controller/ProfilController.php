<?php

namespace App\Controller;

use App\Entity\Demandeur;
use App\Entity\Cv;
use App\Form\DiplomesType;
use App\Form\ExperiencesType;
use App\Form\CompetencesType;
use App\Form\SearchedJobType;
use App\Form\IsActifType;
use App\Form\PersonnelleType;
use App\Form\CvDemandeurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profil(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
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

        // Ajout du formulaire CvDemandeurType
        $formCvDemandeur = $this->createForm(CvDemandeurType::class, $user);

        $formDiplomes->handleRequest($request);
        $formExperiences->handleRequest($request);
        $formCompetences->handleRequest($request);
        $formJobDetails->handleRequest($request);
        $formIsActif->handleRequest($request);
        $formPersonnelle->handleRequest($request);
        $formCvDemandeur->handleRequest($request);

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
            $this->addFlash('success', 'Les informations personnelles ont été mises à jour.');
            return $this->redirectToRoute('app_profil');
        }

        // Gestion de la soumission du formulaire CvDemandeurType
        if ($formCvDemandeur->isSubmitted() && $formCvDemandeur->isValid()) {
            $cvFile = $formCvDemandeur->get('cvFile')->getData();

            if ($cvFile) {
                $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $cvFile->guessExtension();

                try {
                    $cvFile->move(
                        $this->getParameter('cv_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                }

                if ($user instanceof Demandeur){
                    $cv = $user->getCv();
                    if (!$cv) {
                        $cv = new Cv();
                        $randomName = bin2hex(random_bytes(5)); // Génère un nom aléatoire de 10 caractères hexadécimaux
                        $cv->setNom($randomName);
                        $cv->setDemandeur($user); // Assurez-vous de lier le CV au Demandeur
                        $user->setCv($cv);
                    }
                    $cv->setChemin($newFilename); // Assurez-vous que le chemin du fichier est défini correctement
                    $entityManager->persist($cv);
                }
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre CV a été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/profil.html.twig', [
            'formDiplomes' => $formDiplomes->createView(),
            'formExperiences' => $formExperiences->createView(),
            'formCompetences' => $formCompetences->createView(),
            'formJobDetails' => $formJobDetails->createView(),
            'formPersonnelle' => $formPersonnelle->createView(),
            'formIsActif' => $formIsActif->createView(),
            'formCvDemandeur' => $formCvDemandeur->createView(),
            'demandeur' => $user,
        ]);
    }
}
