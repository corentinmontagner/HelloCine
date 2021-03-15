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
        $repository = $entityManager->getRepository(Film::class);
        $films = $repository->findAll();

        foreach ($films as $film) {
            $entityManager->remove($film);
            $entityManager->flush();
        }

        $film = new Film();
        $film
            ->setTitre('Star Wars')
            ->setDateDeSortie(new \DateTime('2021-08-27'))
            ->setDuree(new \DateTime('01:58'))
            ->setNote(17)
            ->setGenre('SF')
        ;

        $entityManager->persist($film);
        $entityManager->flush();

        $filmForm = $this->createForm(FilmType::class, $film);

        $filmForm->handleRequest($request);

        if($filmForm->isSubmitted() && $filmForm->isValid()){
            dump($film);
        } else {
            dump('not valid');
        }

        return $this->render(
            "film/index.html.twig",
            [
                "filmForm" => $filmForm->createView()
            ]);
    }
}
