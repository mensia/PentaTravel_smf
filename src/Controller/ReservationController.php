<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Reservation;
use App\Entity\Hotel;
use App\Entity\Chambre;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ReservationType;
// use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;



class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="app_reservation")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Reservation::class);
        $tab = $repository->findAll();

        return $this->render('reservation/index.html.twig', [
            'tab' => $tab,
        ]);
    }

    /**
     * @Route("reservation/add/{id}", name="reservationAdd")
     */
    public function Add(
        $id,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        // $request = new Request;
        // $entityManager = new EntityManagerInterface;
        $res = new Reservation();
        $form = $this->createForm(ReservationType::class, $res);
        $repository = $this->getDoctrine()->getRepository(Chambre::class);
        $chambre = $repository->find($id);
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $hotel = $repository->find($chambre->getHotel());
        // console.log("Message here");
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $res->setIdUser(0);
            $res->setHotel($hotel);
            $res->setNumChambre($chambre->getNumber());
            $res->setDescription($chambre->getDescription());
            $res->setChambre($chambre);
            $res->setPrix(999);

            $entityManager->persist($res);

            $entityManager->flush();

            return $this->redirectToRoute('app_vol');
        }

        return $this->render('reservation/new.html.twig', [
            'reservationForm' => $form->createView(),
        ]);
    }
}
