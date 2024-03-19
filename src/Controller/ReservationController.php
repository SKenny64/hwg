<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Transport;
use App\Entity\User;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route('/reservation')]
class ReservationController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_reservation_index', methods: ['GET'])]
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(int $id, Request $request, EntityManagerInterface $entityManager, ReservationRepository $reservationRepository): Response
    {
        $reservation = new Reservation();
        
        $userId = $this->security->getUser()->getId();
        $transport = $entityManager->getRepository(Transport::class)->find($id);
        $user = $entityManager->getRepository(User::class)->find($userId);
        $reservationUser = $reservationRepository->findByUser($user);
        $reservationEvent = $reservationRepository->findByTransport($transport);

        if($reservationUser && $reservationEvent) {
            $this->addFlash('pas success', 'Vous êtes déjà inscrit');
            return $this->redirectToRoute('app_home_show', ['id' => $id], Response::HTTP_SEE_OTHER);
        } else {
            $reservation->setTransport($transport);
            $reservation->setUser( $user );
            $reservation->setDatereservation(new \DateTime());

            $entityManager->persist($reservation);
            $entityManager->flush();
            $this->addFlash('success', 'Inscription validé');
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
            
        }

    }

    #[Route('/{id}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
