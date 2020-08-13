<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PrecommandeController
 * @Route("/backend/precommande")
 */
class PrecommandeController extends AbstractController
{
    private $albumRepository;
    private $commandeRepository;

    public function __construct(AlbumRepository  $albumRepository, CommandeRepository $commandeRepository)
    {
        $this->albumRepository= $albumRepository;
        $this->commandeRepository= $commandeRepository;
    }
    /**
     * @Route("/", name="backend_precommande")
     */
    public function index()
    {
        return $this->render('precommande/index.html.twig', [
            'albums' => $this->albumRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{album}", name="backend_precommande_album", methods={"GET"})
     */
    public function album($album)
    {
        return $this->render('precommande/liste_client.html.twig',[
            'commandes' => $this->commandeRepository->findListeByAlbum($album),
            'album' => $this->albumRepository->findOneBy(['slug'=>$album]),
        ]);
    }
}
