<?php

namespace App\Controller;

use App\Entity\Critique;
use App\Form\CritiqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeCritiqueController extends AbstractController
{
    /**
     * @Route("/home/critique/{id}", name="homecritique")
     */
    public function home(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        // Récupérer tout les films en bdd
        $critiques= $entityManager->getRepository(Critique::class)->findBy(['film'=>$id], array('auteur' => 'ASC'));

        return $this->render(
            "home/homecritique.html.twig",
            [
                "critiques" => $critiques,
                'id' => $id
            ]);
    }
}
