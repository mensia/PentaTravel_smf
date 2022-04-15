<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\HotelType;
use App\Entity\Hotel;
use App\Entity\Chambre;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
     * @Route("/front", name="app_hotelf")
     */
    public function findex(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $tab = $repository->findAll();

        return $this->render('hotel/findex.html.twig', [
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

        if ($form->isSubmitted()&& $form->isValid()) {
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
     * @Route ("/update/{id}" , name="hotelUpdate")
     */
    public function update($id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Hotel::class);
        $hotel = $repository->find($id);
        $form = $this->createForm(HotelType::class, $hotel);
        $form->add('update', SubmitType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('app_hotel');
        }
        return $this->render('hotel/new.html.twig', ['HotelForm' => $form->createView()]);
    }

    /**
     * @Route ("/delete/{id}",name="hotelDelete")
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
