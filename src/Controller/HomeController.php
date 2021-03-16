<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer tout les films en bdd
        $films= $entityManager->getRepository(Film::class)->findBy([], array('titre' => 'ASC'));

        return $this->render(
            "home/home.html.twig",
            [
                "films" => $films
            ]);
    }
}
