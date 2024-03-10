<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ImageEvenementRepository;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        EvenementRepository $evenementRepository,
        CategorieRepository $categorieRepository,
        ImageEvenementRepository $imageEvenementRepository
    ): Response
    {
        return $this->render('home/index.html.twig', [
                'evenements' => $evenementRepository->findAll(),
                'categories' => $categorieRepository->findAll(),
                'images' => $imageEvenementRepository->findByCouverture(),
            ]);
    }

    #[Route('/home/{id}', name: 'app_home_show', methods: ['GET'])]
    public function show( 
        $id,
        ImageEvenementRepository $imageEvenementRepository,
    ): Response
    {
        $image = $imageEvenementRepository->findEvent($id);
        $evenment = $image->getEvenement();
        return $this->render('home/show.html.twig', [
            'image' => $image,
            'evenement' => $evenment
        ]);
    }
}
