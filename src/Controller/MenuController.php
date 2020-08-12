<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MenuController
 * @Route("/menu")
 */
class MenuController extends AbstractController
{
    private $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    /**
     * @Route("/", name="menu_horizontal")
     */
    public function index()
    {
        return $this->render('menu/index.html.twig', [
            'genres' => $this->genreRepository->findBy([],['libelle'=>'ASC']),
        ]);
    }

    /**
     * @Route("/mobile", name="menu_mobile")
     */
    public function mobile()
    {
        return $this->render('menu/menu_mobile.html.twig',[
            'genres' => $this->genreRepository->findBy([],['libelle'=>'ASC']),
        ]);
    }
}
