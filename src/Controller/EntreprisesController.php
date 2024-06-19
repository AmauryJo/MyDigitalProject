<?php

namespace App\Controller;

use App\Entity\Entreprises;
use App\Form\EntreprisesType;
use App\Form\EntreprisesLoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class EntreprisesController extends AbstractController
{
    #[Route('/recruteur/inscription', name: 'recruteur_inscription')]
    public function new(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $entreprise = new Entreprises();
        $form = $this->createForm(EntreprisesType::class, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hacher le mot de passe avant de persister l'entité
            $hashedPassword = $passwordHasher->hashPassword(
                $entreprise,
                $entreprise->getEntrPassword()
            );
            $entreprise->setEntrPassword($hashedPassword);

            $em->persist($entreprise);
            $em->flush();

            $this->addFlash('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');

            return $this->redirectToRoute('recruteur_inscription');
        }

        return $this->render('recruteur/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recruteur/connexion', name: 'app_entreprises_connexion')]
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(EntreprisesLoginType::class, [
            'email' => $lastUsername,
        ]);

        return $this->render('recruteur/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}
