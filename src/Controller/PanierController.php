<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Form\PanierType;
use App\Repository\AlbumRepository;
use App\Utilities\GestionMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PanierController
 * @Route("/panier")
 */
class PanierController extends AbstractController
{
    private $albumRepository;
    private $gestionMail;

    public function __construct(AlbumRepository $albumRepository, GestionMail $gestionMail)
    {
        $this->albumRepository = $albumRepository;
        $this->gestionMail = $gestionMail;
    }

    /**
     * @Route("/", name="panier", methods={"GET", "POST"})
     */
    public function index(Request $request)
    {
        $quantite = $request->get('quantite');
        $albumSlug = $request->get('album');

        // Traitement
        $commande = new Commande();
        $form = $this->createForm(PanierType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $montant = $request->get('montant');
            // Ajout de l'album, de la quantité et du montant
            $album = $this->albumRepository->findOneBy(['slug'=>$albumSlug]);
            $commande->addAlbum($album);
            $commande->setQuantite($quantite);
            $commande->setMontant($montant);

            // generation de la reference
            $reference = time();
            $commande->setReference($reference);

            $entityManager->persist($commande);
            $entityManager->flush();

            $this->gestionMail->envoiMail($commande);

            $this->addFlash('success', "Votre commande a été enregistrée avec succès! La facture pro forma vous a été envoyée par mail");

            return $this->redirectToRoute('panier_valide',['reference'=>$commande->getReference()]);
        }

        return $this->render('panier/index.html.twig', [
            'album' => $this->albumRepository->findOneBy(['slug'=>$albumSlug]),
            'qte'=> $quantite,
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{reference}", name="panier_valide", methods={"GET"})
     */
    public function valid(Commande $commande)
    {
        return $this->render('panier/valid.html.twig',[
            'commande' => $commande
        ]);
    }
}
