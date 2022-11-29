<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('serie')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('serie')]
    private $titre;

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: Saison::class, orphanRemoval: false)]
    #[ORM\JoinTable(name: 'saison')]
    private $saisons;

    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'series_jouees', fetch: 'EAGER')]
    #[ORM\JoinTable(name: 'serie_personne_acteur')]
    private $acteurs;

    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'series_realisees', fetch: 'EAGER')]
    #[ORM\JoinTable(name: 'serie_personne_realisateur')]
    private $realisateurs;

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'series')]
    private $categories;

    public function __construct()
    {
        $this->saisons = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
        $this->realisateurs = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return Collection<int, Saison>
     */
    public function getSaisons(): Collection
    {
        return $this->saisons;
    }

    public function addSaison(Saison $saison): self
    {
        if (!$this->saisons->contains($saison)) {
            $this->saisons[] = $saison;
            $saison->setSerie($this);
        }

        return $this;
    }

    public function removeSaison(Saison $saison): self
    {
        if ($this->saisons->removeElement($saison)) {
            // set the owning side to null (unless already changed)
            if ($saison->getSerie() === $this) {
                $saison->setSerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Personne $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Personne $acteur): self
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getRealisateurs(): Collection
    {
        return $this->realisateurs;
    }

    public function addRealisateur(Personne $realisateur): self
    {
        if (!$this->realisateurs->contains($realisateur)) {
            $this->realisateurs[] = $realisateur;
        }

        return $this;
    }

    public function removeRealisateur(Personne $realisateur): self
    {
        $this->realisateurs->removeElement($realisateur);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addSeries($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeSeries($this);
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->getTitre();
    }
}
