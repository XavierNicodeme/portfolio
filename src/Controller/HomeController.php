<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ManagerRegistry $managerRegistry, Request $request, MailerInterface $mailer): Response
    {
        $projets = $managerRegistry->getRepository(Projet::class)->findAll();

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactData = $form->getData();
            $email = (new Email())
                ->from($contactData['email'])
                ->to('nicodemexavier@gmail.com')
                ->subject('Portfolio, nouveau message')
                ->html($this->renderView('contact/contact.html.twig', [
                    'contactData' => $contactData,
                ]));

            $mailer->send($email);
            $this->addFlash("succes", 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'projets' => $projets,
            'form'    => $form->createView()
        ]);
    }
}
