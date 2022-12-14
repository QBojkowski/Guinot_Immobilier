<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/tri/{champ}/{tri}", name="app_categorie_tri", methods={"GET"})
     */
    public function triAsc(PaginatorInterface $paginator, Request $request, CategorieRepository $categorieRepository): Response
    {
        $champ = $request->attributes->get('champ');
        $tri = $request->attributes->get('tri');


        $donnees = $categorieRepository->getTri($champ,$tri);

        $categories = $paginator->paginate(  
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        30 /*limit per page*/
    );
        return $this->render('categorie/index.html.twig', [
        'categories' => $categories,
        'tri' => $tri
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
