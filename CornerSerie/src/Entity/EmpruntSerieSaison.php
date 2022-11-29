<?php

namespace App\Entity;

use App\Repository\EmpruntSerieSaisonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmpruntSerieSaisonRepository::class)]
class EmpruntSerieSaison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('emprunt_serie')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: 'empruntSerieSaisons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('user')]
    private $utilisateur;

    #[ORM\ManyToOne(targetEntity: Saison::class, inversedBy: 'empruntSerieSaisons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('saison')]
    private $saison;

    #[ORM\Column(type: 'datetime')]
    #[Groups('emprunt_serie')]
    private $dateDebut;

    #[ORM\Column(type: 'datetime')]
    #[Groups('emprunt_serie')]
    private $dateFin;

    #[ORM\Column(type: 'boolean')]
    #[Groups('emprunt_serie')]
    private $actif;

    #[ORM\Column(type: 'boolean')]
    #[Groups('emprunt_serie')]
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

    public function getSaison(): ?Saison
    {
        return $this->saison;
    }

    public function setSaison(?Saison $saison): self
    {
        $this->saison = $saison;

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
