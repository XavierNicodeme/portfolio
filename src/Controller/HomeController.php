<?php

namespace App\Controller;

use App\Entity\Projet;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ManagerRegistry $managerRegistry): Response
    {
        $projets = $managerRegistry->getRepository(Projet::class)->findAll();

        return $this->render('home/index.html.twig', [
            'projets' => $projets,
        ]);
    }
}
