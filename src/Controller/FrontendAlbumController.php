<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontendAlbumController extends AbstractController
{
    private $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }
    /**
     * @Route("/frontend/album/", name="frontend_album")
     */
    public function index()
    {
        return $this->render('frontend_album/index.html.twig', [
            'controller_name' => 'FrontendAlbumController',
        ]);
    }

    /**
     * @Route("/{artiste}/album/{slug}", name="frontend_album_show", methods={"GET"})
     */
    public function show($slug)
    {
        return $this->render('frontend_album/show.html.twig',[
            'album' => $this->albumRepository->findOneBy(['slug'=>$slug]),
        ]);
    }
}
