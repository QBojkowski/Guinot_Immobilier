<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\LocationType;
use App\Repository\LocationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="app_location")
     */
    public function index(LocationRepository $locationRepository): Response
    {
        return $this->render('location/index.html.twig', [
            'locations' => $locationRepository->findAll(),
        ]);
    }


    /**
     * @Route("/location/new", name="app_location_new")
     */
    public function nouveau(Request $request, LocationRepository $locationRepository): Response
    {
        // Nouvel Auteur
        $location = new Location();
        
        // Creation du Gabarit du Formulaire
        $form = $this->createForm(LocationType::class, $location);
        
        // Creation du Gabarit du Formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $locationRepository->add($location, true);

            return $this->redirectToRoute('app_location', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('location/new.html.twig', [
            'location' => $location,
            'form' => $form,
        ]);
    }

}
