<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Agence;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AgenceRepository;
use App\Form\AgenceType;
use SebastianBergmann\Environment\Console;

class AgenceController extends AbstractController
{
    /**
     * @param AgenceRepository $repository
     * 
     * @Route("", name="app_agence")
     */
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            // 'controller_name' => 'AgenceController',
        ]);
        // $this->afficheAgence(repository);
    }

    /**
     * @param AgenceRepository $repository
     * @return Response
     * @Route ({"/agence"},name="app_agence")
     */
    public function afficheAgence(AgenceRepository $repository)
    {
        //$repository=$this->getDoctrine()->getRepository(Classroom::class);
        $tabuser = $repository->findAll();
        return $this->render('agence/index.html.twig', [
            'tab' => $tabuser
        ]);
    }

    /**
     * @Route("/add", name="agenceAdd")
     */
    public function Add(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $Agence = new Agence();
        $form = $this->createForm(AgenceType::class, $Agence);

        // console.log("Message here");
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $entityManager->persist($Agence);

            $entityManager->flush();

            return $this->redirectToRoute('app_agence');
        }

        return $this->render('Agence/new.html.twig', [
            'AgenceForm' => $form->createView(),
        ]);
    }

     /**
     * @Route ("/agence/delete/{id}",name="agenceDelete")
     */
    public function Agencedeletee($id)
    {
        $repository=$this->getDoctrine()->getRepository(Agence::class);
        $Agence=$repository->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($Agence);
        $em->flush();
        return $this->redirectToRoute('app_agence');
    }
}
