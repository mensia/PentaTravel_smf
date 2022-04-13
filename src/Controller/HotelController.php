<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ChambreType;
use App\Entity\Hotel;
use App\Entity\Chambre;

/**
 * @Route("/hotel")
 */

class HotelController extends AbstractController
{
    /**
     * @Route("/", name="app_hotel")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $tab = $repository->findAll();

        return $this->render('hotel/index.html.twig', [
            'tab' => $tab,
        ]);
    }

    /**
     * @Route("/add", name="hotelAdd")
     */
    public function Add(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $Hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $Hotel);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $Hotel->setIdResponsable(0);

            $entityManager->persist($Hotel);

            $entityManager->flush();

            return $this->redirectToRoute('app_hotel');
        }

        return $this->render('Hotel/new.html.twig', [
            'HotelForm' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/hotel/delete/{id}",name="hotelDelete")
     */
    public function Hoteldelete($id)
    {
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $Hotel = $repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Hotel);
        $em->flush();
        return $this->redirectToRoute('app_hotel');
    }
}
