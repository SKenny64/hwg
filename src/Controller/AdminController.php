<?php

namespace App\Controller;

use App\Repository\AdresseRepository;
use App\Repository\CategorieRepository;
use App\Repository\ReservationRepository;
use App\Repository\ParticipationRepository;
use App\Repository\EvenementRepository;
use App\Repository\TransportRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Evenement;
use App\Entity\ImageEvenement;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvenementType;
use App\Repository\ImageEvenementRepository;
use App\Form\ImageEvenementType;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(
        ParticipationRepository $participationRepository,
        EvenementRepository $evenementRepository,
        ReservationRepository  $reservationRepository,
        TransportRepository $transportRepository,
        CategorieRepository $categorieRepository,
        UserRepository $userRepository,
        AdresseRepository $adresseRepository,
        ImageEvenementRepository  $imageEvenement
    ): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        return $this->render('admin/index.html.twig', [
            'participations' => $participationRepository->findAll(),
            'evenements' => $evenementRepository->findAll(),
            'reservations' => $reservationRepository->findAll(),
            'transports' => $transportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'categories' => $categorieRepository->findAll(),
            'addresses' => $adresseRepository->findAll(),
            'images' => $imageEvenement->findAll(),
        ]);
    }

    #[Route('/evenement/{id}/edit', name: 'app_admin_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }
}
