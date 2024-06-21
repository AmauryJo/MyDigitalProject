<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Form\EntreprisesType;
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
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('app_home');
        // }

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
    public function profil(): Response
    {
        return $this->render('recruteur/profil.html.twig', [
        ]);
    }
}
