<?php

namespace App\Controller;

use App\Entity\Agence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\VolType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Vol;
use App\Entity\VolCommand;

class VolController extends AbstractController
{

    public function Calcul($agence): int
    {

        $repository = $this->getDoctrine()->getRepository(VolCommand::class);
        // $tab = $repository->findBy(['agence_id' => $agence->getId()]);
        $tab = $repository->findBy(['agence' => $agence]);

        $sum = 0;
        foreach ($tab as $o) {
            $sum += $o->getPrix();
        }
        return $sum;
    }

    /**
     * @Route("/vol", name="app_vol")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $tab = $repository->findAll();

        $profit = 1;
        foreach ($tab as $o) {
            $profit += $this->Calcul($o);
        }
        return $this->render('vol/index.html.twig', [
            'tab' => $tab,
            'title' => 'ALL',
            'profit' => $profit
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
            'title' => $agence->getNom(),
            'profit' => $this->Calcul($agence)
        ]);
    }
    /**
     * @Route("/vol/front/{id}", name="vol_agencef")
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
            'title' => 'Vols',
            'ag' => $agence,
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

        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route ("/update/{id}" , name="volUpdate")
     */
    public function update($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $chambre = $repository->find($id);
        $form = $this->createForm(VolType::class, $chambre);
        $form->add('update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_vol');
        }
        return $this->render('vol/new.html.twig', ['VolForm' => $form->createView()]);
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
