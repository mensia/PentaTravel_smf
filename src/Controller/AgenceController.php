<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AgenceRepository;


class AgenceController extends AbstractController
{
    /**
     * @Route("/agence", name="app_agence")
     */
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }

    /**
     * @param AgenceRepository $repository
     * @return Response
     * @Route ({"/","/afficheAgence"},name="afficheAgence")
     */
    public function afficheAgence(AgenceRepository $repository)
    {
        //$repository=$this->getDoctrine()->getRepository(Classroom::class);
        $tabuser = $repository->findAll();
        return $this->render('agence/index.html.twig', [
            'tab' => $tabuser
        ]);
    }
}
