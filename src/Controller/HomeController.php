<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ImageEvenementRepository;
use App\Repository\ReservationRepository;
use App\Repository\TransportRepository;
use Symfony\Component\HttpFoundation\Request;

#[Route('/')]
class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(
        Request $request,
        EvenementRepository $evenementRepository,
        CategorieRepository $categorieRepository,
        ImageEvenementRepository $imageEvenementRepository
    ): Response
    {
        $form = $this->createForm(SearchType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchTerm = $form->get('searchName')->getData();
            $status = 'Validé';
            return $this->render('home/index.html.twig', [
                'search' => $searchTerm,
                'categories' => $categorieRepository->findAll(),
                'images' => $imageEvenementRepository->findBySearchTermAndStatus($searchTerm, $status),
                'form' => $form
            ]);
        } else {
            $status = 'Validé';
            return $this->render('home/index.html.twig', [
                'search' => null,
                'categories' => $categorieRepository->findAll(),
                'images' => $imageEvenementRepository->findBySearchTermAndStatus(null, $status),
                'form' => $form
            ]);
        }
    }

    
    #[Route('/home/{id}', name: 'app_home_show', methods: ['GET'])]
    public function show( 
        $id,
        ImageEvenementRepository $imageEvenementRepository,
        TransportRepository  $transportRepository,
        ReservationRepository $reservationRepository,
    ): Response
    {
        $transportResa = $transportRepository->findAll();

        $image = $imageEvenementRepository->findEvent($id);
        $evenement = $image->getEvenement();
        $transports = $transportRepository->findByEvents($id);

        $nbreReservations = [];

        foreach ($transportResa as $transport) {
            $idTransport = $transport->getId();
            $nbreReservations[$idTransport] = $reservationRepository->countByTransport($idTransport);
        }


        return $this->render('home/show.html.twig', [
            'image' => $image,
            'evenement' => $evenement,
            'transports' => $transports,
            'nbreReservations' => $nbreReservations,
        ]);
    }
    
    
    #[Route('/home/cat/{id}', name: 'app_home_category', methods: ['GET', 'POST'])]
    public function eventByCategory(
        $id,
        ImageEvenementRepository $imageEvenementRepository,
        CategorieRepository $categorieRepository,
        EvenementRepository $evenementRepository,
        ): Response
        {
        $images = $imageEvenementRepository->findByCategory($id);
        return $this->render('home/categorie.html.twig', [
            'categories' => $categorieRepository->findAll(),
            'images' => $images
        ]);
    }
    
    function compteur_visites($id){

        //vous pouvez modifier le chemin du fichier
        $chemin_stats = "statistiques_visites".$id.".txt";
        
        //stats par défaut
        $aujourdhui = 1;
        
        //si le fichier de stats n'est paos encore créé
        if(!file_exists($chemin_stats)){
            
            //création - première visite
            $tableau_stats = [];
        
        }else{
            
            //ouvre le fichier et récupère les lignes dans un tableau
            $tableau_stats = file($chemin_stats, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        
        }
        
        if(empty($tableau_stats)){
            
            file_put_contents($chemin_stats, date("d-m-Y") . ":1");
            $tableau_stats = [];
            
        }else{

            // Prends le dernier élément du tableau et vérifie si c'est la date d'aujourd'hui
            $derniere_ligne = end($tableau_stats);
            
            // explode() va nous permettre de récupérer la date et le nombre d'affichage de cette journée
            $stat = explode(":", $derniere_ligne);
            
            //si la date de la dernière ligne est aujourd'hui, on rajoute 1 affichage à cette ligne
            if($stat[0] == date("d-m-Y")){
            
            $aujourdhui = ((int) $stat[1]) + 1;
            
            //enlève le dernier element du tableau
            array_pop($tableau_stats);
            
            //pour la remplacer par la nouvelle valeur
            array_push($tableau_stats, date("d-m-Y") . ':' . $aujourdhui);
            
            file_put_contents($chemin_stats, implode("\n", $tableau_stats));
            
            
            //sinon on ajoute une nouvelle ligne pour aujourd'hui
            }else{
            
            //pour la remplacer par la nouvelle valeur
            array_push($tableau_stats, date("d-m-Y") . ':1');
            
            file_put_contents($chemin_stats, implode("\n", $tableau_stats));
            
            }
        }
        
        //statistiques totales depuis le lancement du site
        $total = empty($tableau_stats) ? 1 : 0;
        foreach($tableau_stats as $stat){
            
            $stat = explode(':', $stat);
            
            $total += $stat[1];
            
        }
        
        return [
            'aujourdhui' => $aujourdhui,
            'total' => $total,
            'depuis' => count($tableau_stats),
        ];
        }
}
