<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/frontt", name="app_front")
     */
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'title' => 'FrontController',
        ]);
    }

    /** 
     * @Route("/front", name="front_agence")
     */
    public function indexf(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $tab = $repository->findAll();

        return $this->render('agence/findex.html.twig', [
            'title' => "Les Agence",
        ]);
        // $this->afficheAgence(repository);
    }
}
