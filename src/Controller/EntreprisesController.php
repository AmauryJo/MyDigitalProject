<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Entity\OffreEmploi;
use App\Form\EntreprisesType;
use App\Form\IsActifTypeRecruteur;
use App\Form\InfoEntreprisesType;
use App\Form\OffreEmploiType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Psr\Log\LoggerInterface;



class EntreprisesController extends AbstractController
{
    #[Route('/recruteur/inscription', name: 'recruteur_inscription')]
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('app_home');
        // }

        $entreprise = new Entreprises();
        $form = $this->createForm(EntreprisesType::class, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hacher le mot de passe avant de persister l'entité
            $hashedPassword = $passwordHasher->hashPassword(
                $entreprise,
                $entreprise->getPassword()
            );
            $entreprise->setPassword($hashedPassword);

            $em->persist($entreprise);
            $em->flush();

            $this->addFlash('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');

            return $this->redirectToRoute('app_entreprises_connexion');
        }

        return $this->render('recruteur/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recruteur/connexion', name: 'app_entreprises_connexion')]
    public function connexion(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_entreprises_dashboard');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('recruteur/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/recruteur/dashboard', name: 'app_entreprises_dashboard')]
    public function dashboard(): Response
    {


        return $this->render('recruteur/dashboard.html.twig', [
        ]);
    }

    #[Route('/recruteur/contact', name: 'app_entreprises_contact')]
    public function contact(): Response
    {


        return $this->render('recruteur/contact.html.twig', [
        ]);
    }

    #[Route('/recruteur/profil', name: 'app_entreprises_profil')]
    public function profil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_entreprises_connexion');
        }

        $formIsActifRecruteur = $this->createForm(IsActifTypeRecruteur::class, $user);
        $formIsActifRecruteur->handleRequest($request);

        if ($formIsActifRecruteur->isSubmitted() && $formIsActifRecruteur->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Le statut actif a été mis à jour.');
            return $this->redirectToRoute('app_entreprises_profil');
        }

        $formInformationEntreprise = $this->createForm(InfoEntreprisesType::class, $user);
        $formInformationEntreprise->handleRequest($request);

        if ($formInformationEntreprise->isSubmitted() && $formInformationEntreprise->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Les informations de l\'entreprise ont été mises à jour.');
            return $this->redirectToRoute('app_entreprises_profil');
        }

        return $this->render('recruteur/profil.html.twig', [
            'formIsActif' => $formIsActifRecruteur->createView(),
            'formInfoEntreprises' => $formInformationEntreprise->createView(),
        ]);
    }

    #[Route('/recruteur/annonce', name: 'app_entreprises_annonce')]
    public function annonce(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offre = new OffreEmploi();
        $form = $this->createForm(OffreEmploiType::class, $offre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Définir l'entreprise de l'offre d'emploi (vous devrez peut-être récupérer l'entreprise connectée)
            $entreprise = $this->getUser();
            $offre->setEntreprise($entreprise);

            $entityManager->persist($offre);
            $entityManager->flush();

            $this->addFlash('success', 'Offre d\'emploi ajoutée avec succès.');

            return $this->redirectToRoute('app_entreprises_mesannonces');
        }

        return $this->render('recruteur/annonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recruteur/mesannonces', name: 'app_entreprises_mesannonces')]
    public function mesannonces(): Response
    {


        return $this->render('recruteur/mesannonces.html.twig', [
        ]);
    }

}
