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
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use \Datetime;

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
        MailerInterface $mailer,
        EntityManagerInterface $entityManager
    ): Response {
        $Vol_command = new Volcommand();

        $repository = $this->getDoctrine()->getRepository(Vol::class);
        $vol = $repository->find($id);
        $agence = $vol->getAgence();

        $Vol_command->setIdUser(0);
        $Vol_command->setAgence($agence);
        $Vol_command->setVol($vol);
        $Vol_command->setPrix($vol->getPrix());

        $entityManager->persist($Vol_command);
        $entityManager->flush();
        $today = new DateTime();

        $email = (new Email())
            ->from('hana.mensia@esprit.tn')
            ->to('mouhamedrami.bendhia@esprit.tn')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Notification !')
            ->text('Sent By Penta travel, ' . $agence->getNom())
            ->html('<p> prix :' . $Vol_command->getPrix() . '</p>'
                . '<p> Depart :' . $vol->getDepart() . '</p>'
                . '<p> Destination :' . $vol->getDestination() . '</p>'
                . '<p> Date in :' . $vol->getDate()->diff($today)->format('%d days'). '</p>');

        $mailer->send($email);

        // ...


        return $this->redirectToRoute('app_vol');
    }
}
