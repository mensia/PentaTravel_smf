<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolCommandController extends AbstractController
{
    /**
     * @Route("/vol/command", name="app_vol_command")
     */
    public function index(): Response
    {
        return $this->render('vol_command/index.html.twig', [
            'controller_name' => 'VolCommandController',
        ]);
    }
}
