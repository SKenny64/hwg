<?php

namespace App\Controller;

use App\Entity\TypeTransport;
use App\Form\TypeTransportType;
use App\Repository\TypeTransportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/transport')]
class TypeTransportController extends AbstractController
{
    #[Route('/', name: 'app_type_transport_index', methods: ['GET'])]
    public function index(TypeTransportRepository $typeTransportRepository): Response
    {
        return $this->render('type_transport/index.html.twig', [
            'type_transports' => $typeTransportRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_transport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeTransport = new TypeTransport();
        $form = $this->createForm(TypeTransportType::class, $typeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeTransport);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_transport/new.html.twig', [
            'type_transport' => $typeTransport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_transport_show', methods: ['GET'])]
    public function show(TypeTransport $typeTransport): Response
    {
        return $this->render('type_transport/show.html.twig', [
            'type_transport' => $typeTransport,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_transport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeTransport $typeTransport, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeTransportType::class, $typeTransport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_transport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_transport/edit.html.twig', [
            'type_transport' => $typeTransport,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_transport_delete', methods: ['POST'])]
    public function delete(Request $request, TypeTransport $typeTransport, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeTransport->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeTransport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_transport_index', [], Response::HTTP_SEE_OTHER);
    }
}
