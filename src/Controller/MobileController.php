<?php

namespace App\Controller;

use App\Entity\Agence;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Hotel;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Serializer\Annotation\Ignore;

/**
 *  @Ignore()
 */
class MobileController extends AbstractController
{
    /**
     * @Route("/mobile", name="app_mobile")
     */
    public function index(): Response
    {
        return $this->render('mobile/index.html.twig', [
            'controller_name' => 'MobileController',
        ]);
    }

    /**
     * @Route("/mobileHotel", name="afficheMobilees")
     */
    public function afficheProdMobile(NormalizerInterface $serializer): Response
    {
        $produits = $this->getDoctrine()->getRepository(Hotel::class)->findAll();
        $json = $serializer->normalize($produits, 'json', ['groups' => ['show_product']]);
        return new JsonResponse($json);
    }
    /**
     * @Route("/listAgenceJson", name="afficheAgenceJson")
     */
    public function ListAgence(NormalizerInterface $serializer): Response
    {

        $tabAg = $this->getDoctrine()->getRepository(Agence::class)->findAll();
        // $serializer=new Serializer([new ObjectNormalizer()]);
        $json = $serializer->normalize($tabAg, 'json', ['groups' => ['normal']]);
        return new JsonResponse($json);
    }
    /**
     * @Route ("/ajouterAgenceJson" , name="addAgenceJson" , methods={"GET", "POST"})
     */
    public function ajouterAgence(Request $request)
    {

        $Agence = new Agence();
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Agence::class);
        $em = $this->getDoctrine()->getManager();

        // $DateDebut=$request->query->get("DateDebut");
        // $event->setDateDebut(new \DateTime($DateDebut));

        // $DateFin=$request->query->get("DateFin");
        // $event->setDateFin(new \DateTime($DateFin));

        // $libelle = $request->query->get("idProp");
        $Agence->setidProp(1);
        $obj = $request->query->get("nom");
        $Agence->setNom($obj);
        $obj = $request->query->get("numero");
        $Agence->setNumero($obj);
        $obj = $request->query->get("Address");
        $Agence->setAddress($obj);
        $obj = $request->query->get("nbEtoile");
        $Agence->setNbEtoile($obj);

        $em->persist($Agence);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $aj = $serializer->normalize($Agence);
        return new JsonResponse($aj);
    }
    /**
     * @Route ("/deleteAgenceJson")
     */
    function DeleteAgence(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();

        $Agence = $em->getRepository(Agence::class)->find($id);
        $em->remove($Agence);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $aj = $serializer->normalize("l'Agence a ete supprimee avec success.");
        return new JsonResponse($aj);
    }

    /**
     * @Route ("/DeleteMobileHotel")
     */
    function deleteUser(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(Hotel::class)->find($id);
        $em->remove($user);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $aj = $serializer->normalize("l'hotel a ete supprimee avec success.");
        return new JsonResponse($aj);
    }





    /**
     * @Route ("/AjouterHotel" , name="addProduitMobile" , methods={"GET", "POST"})
     */
    public function ajoutermobile(Request $request)
    {

        $event = new Hotel();
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Hotel::class);
        $em = $this->getDoctrine()->getManager();

        // $DateDebut=$request->query->get("DateDebut");
        // $event->setDateDebut(new \DateTime($DateDebut));

        // $DateFin=$request->query->get("DateFin");
        // $event->setDateFin(new \DateTime($DateFin));

        $libelle = $request->query->get("nom");
        $event->setNom($libelle);
        $event->setIdResponsable(1);
        $event->setLikes(1);
        $event->setNbVotes(1);
        $prix = $request->query->get("Capacite");
        $event->setCapacite($prix);
        $description = $request->query->get("Phone");
        $event->setPhone($description);
        $quantite = $request->query->get("nbEtoile");
        $event->setNbEtoile($quantite);
        $image = $request->query->get("type");
        $event->setType($image);
        $address = $request->query->get("address");
        $event->setAddress($address);
        $em->persist($event);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $aj = $serializer->normalize($event);
        return new JsonResponse($aj);
    }
    /**
     * @Route ("/UpdateHotelMob")
     */
    public function modifierHotel(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $reclamation = $this->getDoctrine()
            ->getRepository(Hotel::class)
            ->find($request->get("id"));
        $reclamation->setIdResponsable(1);
        $reclamation->setNom($request->get("Nom"));
        $reclamation->setCapacite($request->get("Capacite"));
        $reclamation->setPhone($request->get("Phone"));
        $reclamation->setNbEtoile($request->get("nbEtoile"));
        $reclamation->setType($request->get("type"));
        $reclamation->setAddress($request->get("address"));
        $reclamation->setLikes(1);
        $reclamation->setNbVotes(1);


        $em->persist($reclamation);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($reclamation);
        return new JsonResponse("Reclamation a ete modifiee avec success.");
    }
}
