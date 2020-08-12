<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontendProduitController
 * @Route("/frontend/produit")
 */
class FrontendProduitController extends AbstractController
{
    /**
     * @Route("/", name="frontend_produit")
     */
    public function index()
    {
        return $this->render('frontend_produit/index.html.twig', [
            'controller_name' => 'FrontendProduitController',
        ]);
    }

    /**
     * @Route("/{id}", name="frontend_produit_show", methods={"GET"})
     */
    public function show(Album $album)
    {
        return $this->render('frontend_produit/show.html.twig',[
            'album' => $album
        ]);
    }
}
