<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('saison')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Serie::class, inversedBy: 'saisons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('serie')]
    private $serie;

    #[ORM\Column(type: 'integer')]
    #[Groups('saison')]
    private $numero;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $nb_episodes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $affiche;

    #[ORM\Column(type: 'text', nullable: true)]
    private $synopsis;

    #[ORM\OneToMany(mappedBy: 'saison', targetEntity: EmpruntSerieSaison::class)]
    private $empruntSerieSaisons;

    public function __construct()
    {
        $this->empruntSerieSaisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getNbEpisodes(): ?int
    {
        return $this->nb_episodes;
    }

    public function setNbEpisodes(?int $nb_episodes): self
    {
        $this->nb_episodes = $nb_episodes;

        return $this;
    }

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(?string $synopsis): self
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * @return Collection<int, EmpruntSerieSaison>
     */
    public function getEmpruntSerieSaisons(): Collection
    {
        return $this->empruntSerieSaisons;
    }

    public function addEmpruntSerieSaison(EmpruntSerieSaison $empruntSerieSaison): self
    {
        if (!$this->empruntSerieSaisons->contains($empruntSerieSaison)) {
            $this->empruntSerieSaisons[] = $empruntSerieSaison;
            $empruntSerieSaison->setSaison($this);
        }

        return $this;
    }

    public function removeEmpruntSerieSaison(EmpruntSerieSaison $empruntSerieSaison): self
    {
        if ($this->empruntSerieSaisons->removeElement($empruntSerieSaison)) {
            // set the owning side to null (unless already changed)
            if ($empruntSerieSaison->getSaison() === $this) {
                $empruntSerieSaison->setSaison(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->getSerie().' Saison n°'.$this->getNumero();
    }
}
