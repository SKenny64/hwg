<?php

namespace App\Controller;

use App\Entity\ImageEvenement;
use App\Form\ImageEvenementType;
use App\Repository\ImageEvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Evenement;

#[Route('/image/evenement')]
class ImageEvenementController extends AbstractController
{
    #[Route('/', name: 'app_image_evenement_index', methods: ['GET'])]
    public function index(ImageEvenementRepository $imageEvenementRepository): Response
    {
        return $this->render('image_evenement/index.html.twig', [
            'image_evenements' => $imageEvenementRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_image_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $imageEvenement = new ImageEvenement();
        $id =  $request->attributes->get("id");
        $evenement = $entityManager->getRepository(Evenement::class)->find($id);
        $imageEvenement->setEvenement($evenement);
        $form = $this->createForm(ImageEvenementType::class, $imageEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($imageEvenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_home_show', ['id' => $imageEvenement->getEvenement()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_evenement/new.html.twig', [
            'image_evenement' => $imageEvenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_evenement_show', methods: ['GET'])]
    public function show(ImageEvenement $imageEvenement): Response
    {
        return $this->render('image_evenement/show.html.twig', [
            'image_evenement' => $imageEvenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_image_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ImageEvenement $imageEvenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImageEvenementType::class, $imageEvenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_image_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image_evenement/edit.html.twig', [
            'image_evenement' => $imageEvenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_image_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, ImageEvenement $imageEvenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imageEvenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($imageEvenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_image_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
