<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ChambreType;
use App\Entity\Chambre;
use App\Entity\Hotel;

/**
 * @Route("/chambre")
 */
class ChambreController extends AbstractController
{
    /**
     * @Route("/", name="app_chambre")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Chambre::class);
        $tab = $repository->findAll();

        return $this->render('chambre/index.html.twig', [
            'tab' => $tab,
        ]);
    }

    /**
     * @Route("/{id}", name="chambre_hotel")
     */
    public function Chambredhotel($id): Response
    {
        // $repository = $this->getDoctrine()->getRepository(Chambre::class);
        // $tab = $repository->findBy(['hotel_id' => $id]);

        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $hotel = $repository->find($id);
        $tab = $hotel->getChambres();
        return $this->render('chambre/index.html.twig', [
            'tab' => $tab,
        ]);
    }
    /**
     * @Route("/add/{id}", name="chambreAdd")
     */
    public function Add(
        $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // $request = new Request;
        // $entityManager = new EntityManagerInterface;
        $Chambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $Chambre);
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $hotel = $repository->find($id);
        // console.log("Message here");
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $Chambre->setHotel($hotel);

            $entityManager->persist($Chambre);

            $entityManager->flush();

            return $this->redirectToRoute('app_chambre');
        }

        return $this->render('Chambre/new.html.twig', [
            'ChambreForm' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/update/{id}" , name="ChambreUpdate")
     */
    public function update($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Chambre::class);
        $chambre = $repository->find($id);
        $form = $this->createForm(ChambreType::class, $chambre);
        $form->add('update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_chambre');
        }
        return $this->render('chambre/newChambre.html.twig', ['ChambreForm' => $form->createView()]);
    }

    /**
     * @Route ("/chambre/delete/{id}",name="chambreDelete")
     */
    public function chambreDelete($id)
    {
        $repository = $this->getDoctrine()->getRepository(Chambre::class);
        $chambre = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($chambre);
        $em->flush();
        return $this->redirectToRoute('app_chambre');
    }
}
