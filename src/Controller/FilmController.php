<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $film = new Film();

        $filmForm = $this->createForm(FilmType::class, $film);

        $filmForm->handleRequest($request);

        if($filmForm->isSubmitted()){
            if($filmForm->isValid()){
                $entityManager->persist($film);
                $entityManager->flush();

                return $this->redirectToRoute('home');
            }
        }

        return $this->render(
            "film/index.html.twig",
            [
                "filmForm" => $filmForm->createView()
            ]);
    }
}
