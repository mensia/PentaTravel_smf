<?php

namespace App\Controller;

use App\Entity\Agence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VolType;

use App\Entity\Vol;

class VolController extends AbstractController
{
    /**
     * @Route("/vol", name="app_vol")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $tab = $repository->findAll();
        return $this->render('vol/index.html.twig', [
            'tab' => $tab,
        ]);
    }
    /**
     * @Route("/vol/{id}", name="vol_agence")
     */
    public function VoldAgence($id): Response
    {
        // $repository = $this->getDoctrine()->getRepository(Vol::class);
        // $tab = $repository->findBy(['agence_id' => $id]);

        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $agence = $repository->find($id);
        $tab = $agence->getVols();
        return $this->render('vol/index.html.twig', [
            'tab' => $tab,
        ]);
    }
    /**
     * @Route("/front/vol/{id}", name="vol_agencef")
     */
    public function VoldAgencef($id): Response
    {
        // $repository = $this->getDoctrine()->getRepository(Vol::class);
        // $tab = $repository->findBy(['agence_id' => $id]);

        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $agence = $repository->find($id);
        $tab = $agence->getVols();
        return $this->render('vol/findex.html.twig', [
            'tab' => $tab,
        ]);
    }
    /**
     * @Route("vol/add/{id}", name="volAdd")
     */
    public function Add(
        $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // $request = new Request;
        // $entityManager = new EntityManagerInterface;
        $Vol = new Vol();
        $form = $this->createForm(VolType::class, $Vol);
        $repository = $this->getDoctrine()->getRepository(Agence::class);
        $agence = $repository->find($id);
        // console.log("Message here");
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
            $Vol->setAgence($agence);

            $entityManager->persist($Vol);

            $entityManager->flush();

            return $this->redirectToRoute('app_vol');
        }

        return $this->render('Vol/new.html.twig', [
            'VolForm' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/vol/delete/{id}",name="volDelete")
     */
    public function volDelete($id)
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $vol = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($vol);
        $em->flush();
        return $this->redirectToRoute('app_vol');
    }
}
