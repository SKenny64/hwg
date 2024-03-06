<?php

namespace App\Controller;

use App\Entity\CoordonneesUtilisateur;
use App\Form\CoordonneesUtilisateurType;
use App\Repository\CoordonneesUtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coordonnees/utilisateur')]
class CoordonneesUtilisateurController extends AbstractController
{
    #[Route('/', name: 'app_coordonnees_utilisateur_index', methods: ['GET'])]
    public function index(CoordonneesUtilisateurRepository $coordonneesUtilisateurRepository): Response
    {
        return $this->render('coordonnees_utilisateur/index.html.twig', [
            'coordonnees_utilisateurs' => $coordonneesUtilisateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coordonnees_utilisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coordonneesUtilisateur = new CoordonneesUtilisateur();
        $form = $this->createForm(CoordonneesUtilisateurType::class, $coordonneesUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coordonneesUtilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_coordonnees_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coordonnees_utilisateur/new.html.twig', [
            'coordonnees_utilisateur' => $coordonneesUtilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coordonnees_utilisateur_show', methods: ['GET'])]
    public function show(CoordonneesUtilisateur $coordonneesUtilisateur): Response
    {
        return $this->render('coordonnees_utilisateur/show.html.twig', [
            'coordonnees_utilisateur' => $coordonneesUtilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coordonnees_utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CoordonneesUtilisateur $coordonneesUtilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoordonneesUtilisateurType::class, $coordonneesUtilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coordonnees_utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coordonnees_utilisateur/edit.html.twig', [
            'coordonnees_utilisateur' => $coordonneesUtilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coordonnees_utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, CoordonneesUtilisateur $coordonneesUtilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coordonneesUtilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($coordonneesUtilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coordonnees_utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
