<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use App\Repository\ParticipationRepository;
use App\Repository\EvenementRepository;
use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(
        ParticipationRepository $participationRepository,
        EvenementRepository $evenementRepository,
        ReservationRepository  $reservationRepository,
        TransportRepository $transportRepository
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

        return $this->render('dashboard/index.html.twig', [
            'participations' => $participationRepository->findAll(),
            'evenements' => $evenementRepository->findAll(),
            'reservations' => $reservationRepository->findAll(),
            'transports' => $transportRepository->findAll(),
            'compteurs' => $compteurs
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
