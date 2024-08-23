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
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;




class EntreprisesController extends AbstractController
{
    #[Route('/recruteur/inscription', name: 'recruteur_inscription')]
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {

        $entreprise = new Entreprises();
        $form = $this->createForm(EntreprisesType::class, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
    public function annonce(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $offreEmploi = new OffreEmploi();
        $form = $this->createForm(OffreEmploiType::class, $offreEmploi);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'upload de l'image
            $imageFile = $form->get('imageFile')->getData();
    
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
    
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'), // Répertoire de destination configuré dans services.yaml
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer l'exception si quelque chose se produit pendant le téléchargement du fichier
                    // Par exemple, en ajoutant un message flash pour l'utilisateur
                    $this->addFlash('error', 'Une erreur s\'est produite lors du téléchargement de l\'image.');
                    return $this->redirectToRoute('app_entreprises_annonce');
                }
    
                // Mettre à jour l'entité OffreEmploi avec le nom du fichier
                $offreEmploi->setImageFilename($newFilename);
            }

            $entreprise = $this->getUser();
            $offreEmploi->setEntreprise($entreprise);
    
            // Enregistrer l'offre d'emploi en base de données
            $entityManager->persist($offreEmploi);
            $entityManager->flush();
    
            // Redirection vers une page de confirmation ou une autre action
            return $this->redirectToRoute('app_entreprises_profil');
        }
    
        return $this->render('recruteur/annonce.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recruteur/mesannonces/{id}', name: 'app_entreprises_mesannonces')]
    public function mesannonces($id, EntityManagerInterface $entityManager): Response
    {
        $offreEmploi = $entityManager->getRepository(OffreEmploi::class)->find($id);

        if (!$offreEmploi) {
            throw $this->createNotFoundException('L\'annonce n\'existe pas.');
        }
    
        return $this->render('recruteur/mesannonces.html.twig', [
            'offreEmploi' => $offreEmploi,
        ]);
    }

    #[Route('/recruteur/listeannonce', name: 'app_entreprises_listeannonce')]
    public function listeannonce( EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'entreprise actuellement connectée
        /** @var Entreprises|null $entreprise */
        $entreprise = $this->getUser();

        if (!$entreprise) {
            return $this->redirectToRoute('app_entreprises_connexion');
        }

        // Récupérer toutes les offres d'emploi liées à cette entreprise
        $offresEmploi = $entityManager->getRepository(OffreEmploi::class)->findBy(['entreprise' => $entreprise]);

        return $this->render('recruteur/listeannonce.html.twig', [
            'offresEmploi' => $offresEmploi,
        ]);
    }

}
