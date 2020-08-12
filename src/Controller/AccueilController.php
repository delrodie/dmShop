<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Utilities\GestionLog;
use App\Utilities\GestionMail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private $gestMail;
    private $log;
    private $albumrepository;

    public function __construct(GestionMail $gestionMail, GestionLog $log, AlbumRepository $albumRepository)
    {
        $this->gestMail= $gestionMail;
        $this->log = $log;
        $this->albumrepository = $albumRepository;
    }

    /**
     * @Route("/", name="app_accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig', [
            'albums' => $this->albumrepository->findBy([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function dashboard(Request $request)
    {
        $user = $this->getUser();
        $this->log->addLog($user, 'dashboard', $request->getClientIp());
        return $this->render("backoffice/index.html.twig");
    }
}
