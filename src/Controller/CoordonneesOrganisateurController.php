<?php

namespace App\Controller;

use App\Entity\CoordonneesOrganisateur;
use App\Form\CoordonneesOrganisateurType;
use App\Repository\CoordonneesOrganisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coordonnees/organisateur')]
class CoordonneesOrganisateurController extends AbstractController
{
    #[Route('/', name: 'app_coordonnees_organisateur_index', methods: ['GET'])]
    public function index(CoordonneesOrganisateurRepository $coordonneesOrganisateurRepository): Response
    {
        return $this->render('coordonnees_organisateur/index.html.twig', [
            'coordonnees_organisateurs' => $coordonneesOrganisateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_coordonnees_organisateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $coordonneesOrganisateur = new CoordonneesOrganisateur();
        $form = $this->createForm(CoordonneesOrganisateurType::class, $coordonneesOrganisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($coordonneesOrganisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_coordonnees_organisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coordonnees_organisateur/new.html.twig', [
            'coordonnees_organisateur' => $coordonneesOrganisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coordonnees_organisateur_show', methods: ['GET'])]
    public function show(CoordonneesOrganisateur $coordonneesOrganisateur): Response
    {
        return $this->render('coordonnees_organisateur/show.html.twig', [
            'coordonnees_organisateur' => $coordonneesOrganisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_coordonnees_organisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CoordonneesOrganisateur $coordonneesOrganisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoordonneesOrganisateurType::class, $coordonneesOrganisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_coordonnees_organisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('coordonnees_organisateur/edit.html.twig', [
            'coordonnees_organisateur' => $coordonneesOrganisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_coordonnees_organisateur_delete', methods: ['POST'])]
    public function delete(Request $request, CoordonneesOrganisateur $coordonneesOrganisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coordonneesOrganisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($coordonneesOrganisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_coordonnees_organisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
