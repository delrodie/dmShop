<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Repository\AlbumRepository;
use App\Utilities\GestionArtiste;
use App\Utilities\GestionMedia;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/backend/album")
 */
class AlbumController extends AbstractController
{
    private $slugger;
    private $albumRepository;
    private $gestionArtiste;
    private $gestionMedia;

    public function __construct(SluggerInterface $slugger, AlbumRepository $albumRepository, GestionArtiste $gestionArtiste, GestionMedia $gestionMedia)
    {
        $this->slugger = $slugger;
        $this->albumRepository = $albumRepository;
        $this->gestionArtiste = $gestionArtiste;
        $this->gestionMedia = $gestionMedia;
    }

    /**
     * @Route("/", name="album_index", methods={"GET","POST"})
     */
    public function index(Request $request, AlbumRepository $albumRepository): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($album);
            $entityManager->flush();

            return $this->redirectToRoute('album_index');
        }

        return $this->render('album/index.html.twig', [
            'albums' => $albumRepository->findAll(),
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="album_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //Slug
            $slug = $this->slugger->slug($album->getTitre());
            $exist = $this->albumRepository->findOneBy(['slug'=>$slug]);
            if ($exist){
                $this->addFlash('error',"Cet album a déjà été enregistré!");

                return $this->redirectToRoute('album_new');
            }else{
                $album->setSlug($slug);
            }



            // Gestion des fichiers
            $mediaFile = $form->get('pochette')->getData();

            // Traitement du fichier s'il a été telechargé
            if ($mediaFile){
                $media = $this->gestionMedia->upload($mediaFile, 'pochette');

                $album->setPochette($media);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($album);
            $entityManager->flush();

            $this->gestionArtiste->addAlbum($album->getArtiste()->getId());

            $this->addFlash('success', "L'album a été enregisré avec succès!");

            return $this->redirectToRoute('album_index');
        }

        return $this->render('album/new.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="album_show", methods={"GET"})
     */
    public function show(Album $album): Response
    {
        return $this->render('album/show.html.twig', [
            'album' => $album,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="album_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Album $album): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('album_index');
        }

        return $this->render('album/edit.html.twig', [
            'album' => $album,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="album_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Album $album): Response
    {
        if ($this->isCsrfTokenValid('delete'.$album->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($album);
            $entityManager->flush();
        }

        return $this->redirectToRoute('album_index');
    }
}
