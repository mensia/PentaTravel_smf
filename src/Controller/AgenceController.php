<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Agence;
use App\Entity\Favoriet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AgenceRepository;
use App\Form\AgenceType;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/agence")
 */

class AgenceController extends AbstractController
{
    /** 
     * @Route("/", name="app_agence")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $tab = $repository->findAll();

        return $this->render('agence/index.html.twig', [
            'tab' => $tab,
        ]);
        // $this->afficheAgence(repository);
    }
    /** 
     * @Route("/front", name="app_agencef")
     */
    public function indexf(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $tab = $repository->findAll();

        return $this->render('agence/findex.html.twig', [
            'title' => "Agence",
            'tab' => $tab,
        ]);
        // $this->afficheAgence(repository);
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

        if ($form->isSubmitted() && $form->isValid()) {
            $Agence->setIdProp(0);

            $entityManager->persist($Agence);

            $entityManager->flush();

            return $this->redirectToRoute('app_agence');
        }

        return $this->render('Agence/new.html.twig', [
            'AgenceForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/fav/{id}", name="AgenceFav")
     */
    public function Fav(
        $id
    ): Response {
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $Agence = $repository->find($id);
        $fav = new Favoriet();
        $fav->setUser(0);
        $fav->setAgence($Agence);

        $em = $this->getDoctrine()->getManager();
        $em->persist($fav);

        $em->flush();

        return $this->redirectToRoute('app_agencef');

    }

    /**
     * @Route ("/update/{id}" , name="agenceUpdate")
     */
    public function update($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $Agence = $repository->find($id);
        $form = $this->createForm(AgenceType::class, $Agence);
        $form->add('update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_agence');
        }
        return $this->render('agence/new.html.twig', ['AgenceForm' => $form->createView()]);
    }
    /**
     * @Route ("/agence/delete/{id}",name="agenceDelete")
     */
    public function Agencedelete($id)
    {
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $Agence = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Agence);
        $em->flush();
        return $this->redirectToRoute('app_agence');
    }
}
