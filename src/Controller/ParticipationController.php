<?php

namespace App\Controller;

use App\Entity\Participation;
use App\Entity\Evenement;
use App\Form\ParticipationType;
use App\Repository\ParticipationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;
use App\Entity\User;

#[Route('/participation')]
class ParticipationController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/', name: 'app_participation_index', methods: ['GET'])]
    public function index(ParticipationRepository $participationRepository): Response
    {
        return $this->render('participation/index.html.twig', [
            'participations' => $participationRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_participation_new', methods: ['GET', 'POST'])]
    public function new(int $id, Request $request, EntityManagerInterface $entityManager, ParticipationRepository $participationRepository): Response
    {
        $participation = new Participation();

        $userId = $this->security->getUser()->getId();
        $evenement = $entityManager->getRepository(Evenement::class)->find($id);
        $user = $entityManager->getRepository(User::class)->find($userId);
        $participationUser = $participationRepository->findByUser($user);
        $participationEvent = $participationRepository->findByEvent($evenement);

        if($participationUser && $participationEvent) {
            $this->addFlash('pas success', 'Vous êtes déjà inscrit');
            return $this->redirectToRoute('app_home_show', ['id' => $id], Response::HTTP_SEE_OTHER);
        } else {
            $participation->setEvenement($evenement);
            $participation->setUser( $user );
            $participation->setDateParticipation(new \DateTime());

            $entityManager->persist($participation);
            $entityManager->flush();
            $this->addFlash('success', 'Inscription validé');
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
            
        }

        if($this->security->getUser()->getRoles() == ['ROLE_ADMIN']) {
            $form = $this->createForm(ParticipationType::class, $participation);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($participation);
                $entityManager->flush();

                return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
            }
        }
    }

    #[Route('/{id}', name: 'app_participation_show', methods: ['GET'])]
    public function show(Participation $participation): Response
    {
        return $this->render('participation/show.html.twig', [
            'participation' => $participation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('participation/edit.html.twig', [
            'participation' => $participation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_participation_delete', methods: ['POST'])]
    public function delete(int $id, Request $request, Participation $participation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }
}
