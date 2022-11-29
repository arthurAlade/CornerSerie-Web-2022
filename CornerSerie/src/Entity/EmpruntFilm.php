<?php

namespace App\Entity;


use App\Repository\EmpruntFilmRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmpruntFilmRepository::class)]
class EmpruntFilm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('emprunt_film')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'empruntFilms')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('user')]
    private $utilisateur;

    #[ORM\ManyToOne(targetEntity: Film::class, inversedBy: 'emprunt')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('film')]
    private $film;

    #[ORM\Column(type: 'datetime')]
    #[Groups('emprunt_film')]
    private $dateDebut;

    #[ORM\Column(type: 'datetime')]
    #[Groups('emprunt_film')]
    private $dateFin;

    #[ORM\Column(type: 'boolean')]
    #[Groups('emprunt_film')]
    private $actif;

    #[ORM\Column(type: 'boolean')]
    #[Groups('emprunt_film')]
    private $restituer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getRestituer(): ?bool
    {
        return $this->restituer;
    }

    public function setRestituer(bool $restituer): self
    {
        $this->restituer = $restituer;

        return $this;
    }
}
