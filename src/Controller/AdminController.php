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
use App\Entity\Participation;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EvenementType;
use App\Repository\ImageEvenementRepository;
use App\Entity\Transport;
use App\Form\TransportType;
use App\Repository\TypeTransportRepository;

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

        $evenements = $evenementRepository->findAll();

        $compteurs = [];

        // Parcourir chaque événement et récupérer les compteurs
        foreach ($evenements as $evenement) {
            $idEvenement = $evenement->getId();
            $compteurs[$idEvenement] = $this->compteur_visites($idEvenement);
        }

        return $this->render('admin/index.html.twig', [
            'participations' => $participationRepository->findAll(),
            'evenements' => $evenementRepository->findAll(),
            'reservations' => $reservationRepository->findAll(),
            'transports' => $transportRepository->findAll(),
            'users' => $userRepository->findAll(),
            'categories' => $categorieRepository->findAll(),
            'addresses' => $adresseRepository->findAll(),
            'images' => $imageEvenement->findAll(),
            'compteurs' => $compteurs
        ]);
    }
    
    #[Route('/evenement/{id}/edit', name: 'app_admin_evenement_edit', methods: ['GET', 'POST'])]
    public function evenementEdit(
        Request $request, 
        Evenement $evenement, 
        EntityManagerInterface $entityManager
    ): Response
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

    #[Route('/categorie', name: 'app_admin_categorie', methods: ['GET', 'POST'])]
    public function categorie(
        CategorieRepository $categorieRepository, 
    ): Response
    {
        return $this->render('admin/categorie.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]); 
    }

    #[Route('/participation', name: 'app_admin_participation', methods: ['GET', 'POST'])]
    public function participation(
        Request $request, 
        ParticipationRepository $participationRepository, 
        EvenementRepository $evenementRepository,
    ) :Response
    {

        $participations = $participationRepository->findAll();
        $evenements = $evenementRepository->findAll();

        $users = [];
        $eventId = [];

        foreach ($participations as $participation) {
            $users[] = $participation->getUser();
        }

        foreach ($evenements as $evenement) {
            $eventId[] = $evenement->getId();
        }

        return $this->render('admin/participation.html.twig',[
            'participations' => $participations,
            'eventId' => $eventId
        ]);
    }

    #[Route('/transport', name: 'app_admin_transport', methods: ['GET', 'POST'])]
    public function transport(
        TransportRepository $transportRepository
    ): Response
    {
        return $this->render('admin/transport.html.twig', [
            'transports' => $transportRepository->findAll(),
        ]);
    }

    #[Route('transport/{id}/edit', name: 'app_admin_transport_edit', methods: ['GET', 'POST'])]
    public function transportEdit(Request $request, Transport $transport, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $form = $this->createForm(TransportType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('transport/edit.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }

    #[Route('/type_transport', name: 'app_admin_typetransport', methods: ['GET', 'POST'])]
    public function typeTransport(
        TypeTransportRepository $typeTransportRepository, 
    ): Response
    {
        return $this->render('admin/typetransport.html.twig', [
            'typeTransports' => $typeTransportRepository->findAll(),
        ]); 
    }

    #[Route('/reservation', name: 'app_admin_reservation', methods: ['GET', 'POST'])]
    public function reservation(
        ReservationRepository $reservationRepository
    ): Response
    {
        return $this->render('admin/reservation.html.twig', [
            'reservations' => $reservationRepository->findAll(),
        ]);
    }

    function compteur_visites($id){
    
        //vous pouvez modifier le chemin du fichier
        $chemin_stats = "statistiques_visites".$id.".txt";
        
        //ouvre le fichier et récupère les lignes dans un tableau
        $tableau_stats = file($chemin_stats, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        
      
        //statistiques totales depuis le lancement du site
        $total = empty($tableau_stats) ? 1 : 0;
        foreach($tableau_stats as $stat){
          
          $stat = explode(':', $stat);

          $total += $stat[1];
            
        }
        
        return [
          'total' => $total,
          'depuis' => count($tableau_stats),
        ];
        dd(count($tableau_stats));
    }
}
