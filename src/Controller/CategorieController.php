<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="app_categorie")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {

        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/categorie/new", name="app_categorie_new")
     */
    public function nouveau(Request $request, CategorieRepository $categorieRepository): Response
    {
                 // Nouvelle Categorie
                 $categorie = new Categorie();
        
                 // Creation du Gabarit du Formulaire
                 $form = $this->createFormBuilder($categorie)
                                     
        // Ajouter les prop de mon formulaire
                ->add('titre')
                ->add('resume')

            // Demande le résultat
            ->getForm();
        
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $categorieRepository->add($categorie, true);
    
                return $this->redirectToRoute('app_categorie', [], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('categorie/new.html.twig', [
                'categorie' => $categorie,
                'form' => $form,
            ]);
    }


    
}
