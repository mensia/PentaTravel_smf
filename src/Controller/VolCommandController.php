<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VolcommandType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\VolCommand;
use App\Entity\Vol;
use App\Entity\Agence;

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

    /**
     * @Route("volcom/{id}", name="volcAdd")
     */
    public function Add(
        $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // $request = new Request;
        // $entityManager = new EntityManagerInterface;
        $Vol_command = new Volcommand();
        // $form = $this->createForm(VolcommandType::class, $Vol_command);
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $vol = $repository->find($id);
        // $repository = $this->getDoctrine()->getRepository(Agence::class);
        // $agence = $repository->find($vol->getAgence());
        $agence = $vol->getAgence();
        // console.log("Message here");
        // $form->handleRequest($request);

        $Vol_command->setIdUser(0);
        $Vol_command->setAgence($agence);
        $Vol_command->setVol($vol);
        $Vol_command->setPrix($vol->getPrix());

        $entityManager->persist($Vol_command);

        $entityManager->flush();

        return $this->redirectToRoute('app_vol');
    }
}
