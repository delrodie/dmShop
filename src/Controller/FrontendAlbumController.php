<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FrontendAlbumController
 * @Route("/frontend/album")
 */
class FrontendAlbumController extends AbstractController
{
    /**
     * @Route("/", name="frontend_album")
     */
    public function index()
    {
        return $this->render('frontend_album/index.html.twig', [
            'controller_name' => 'FrontendAlbumController',
        ]);
    }

    /**
     * @Route("/{slug}", name="frontend_album_show", methods={"GET"})
     */
    public function show(Album $album)
    {
        return $this->render('frontend_album/show.html.twig',[
            'album' => $album
        ]);
    }
}
