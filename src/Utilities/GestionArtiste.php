<?php


namespace App\Utilities;


use App\Repository\ArtisteRepository;
use Doctrine\ORM\EntityManagerInterface;

class GestionArtiste
{
    private $artisteRepository;
    private $entityManager;

    public function __construct(ArtisteRepository $artisteRepository, EntityManagerInterface  $entityManager)
    {
        $this->artisteRepository = $artisteRepository;
        $this->entityManager = $entityManager;
    }

    public function addAlbum($artisteID)
    {
        $artiste = $this->artisteRepository->findOneBy(['id'=>$artisteID]);
        $artiste->setNombreAlbum($artiste->getNombreAlbum()+1);

        $this->entityManager->flush();

        return true;
    }
}