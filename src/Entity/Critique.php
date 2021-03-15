<?php

namespace App\Entity;

use App\Repository\CritiqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CritiqueRepository::class)
 */
class Critique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $texte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auteur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDePublication;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="critiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Film::class, inversedBy="critiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->dateDePublication;
    }

    public function setDateDePublication(?\DateTimeInterface $dateDePublication): self
    {
        $this->dateDePublication = $dateDePublication;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFilm(): ?film
    {
        return $this->film;
    }

    public function setFilm(?film $film): self
    {
        $this->film = $film;

        return $this;
    }
}
