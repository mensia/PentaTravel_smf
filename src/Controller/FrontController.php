<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Entity\Favoriet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\VolCommand;
use \Datetime;

class FrontController extends AbstractController
{
    /**
     * @Route("/fronttt", name="app_front")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'title' => 'FrontController',
        ]);
    }
    /**
     * @Route("/schedual", name="front_schedual")
     */
    public function CalculJour(): Response
    {

        $repository = $this->getDoctrine()->getRepository(VolCommand::class);
        $tab = $repository->findBy(['idUser' => 0]);

        $tabDif = array();
        $today = new DateTime();
        // getTimestamp();
        foreach ($tab as $o) {
            $dif = new Schedual();
            $dif->vol = $o->getVol();
            $dif->diff = $o->getVol()->getDate()->diff($today)->format('%d days');
            array_push($tabDif, $dif);
        }
        return $this->render('front/schedual.html.twig', [
            'title' => 'schedual',
            'diff' => $tabDif,
        ]);
    }
    /**
     * @Route("/fav", name="front_fav")
     */
    public function fav(): Response
    {

        $repository = $this->getDoctrine()->getRepository(Favoriet::class);
        $tab = $repository->findBy(['user' => 0]);

     
        return $this->render('front/fav.html.twig', [
            'title' => 'Fav',
            'tab' => $tab,
        ]);
    }
}

class Schedual
{
    public $diff;
    public $vol;
}
