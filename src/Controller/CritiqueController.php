<?php

namespace App\Controller;

use App\Entity\Critique;
use App\Entity\Film;
use App\Form\CritiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CritiqueController extends AbstractController
{
    /**
     * @Route("/critique/{id}", name="critique")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $critique = new Critique();

        $film = $entityManager->getRepository(Film::class)->find($id);

        $critique
            ->setFilm($film);

        $critiqueForm = $this->createForm(CritiqueType::class, $critique);

        $critiqueForm->handleRequest($request);

        if($critiqueForm->isSubmitted()){
            if($critiqueForm->isValid()){
                $entityManager->persist($critique);
                $entityManager->flush();

                return $this->redirectToRoute('homecritique', array('id' => $id));
            }
        }

        return $this->render(
            "critique/index.html.twig",
            [
                "critiqueForm" => $critiqueForm->createView()
            ]);
    }

    /**
     * @Route("/critique/edit/{id}", name="critique_edit")
     */
    public function edit(Request $request, EntityManagerInterface $entityManager, int $id)
    {
        $critique = $entityManager->getRepository(Critique::class)->find($id);

        $filmId = $critique->getFilm()->getId();

        $critiqueForm = $this->createForm(CritiqueType::class, $critique);

        $critiqueForm->handleRequest($request);

        if($critiqueForm->isSubmitted()){
            if($critiqueForm->isValid()){
                $entityManager->flush();

                return $this->redirectToRoute('homecritique', array('id' => $filmId));
            }
        }

        return $this->render(
            "critique/index.html.twig",
            [
                "critiqueForm" => $critiqueForm->createView()
            ]);
    }
}
