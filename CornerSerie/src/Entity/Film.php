<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FilmRepository::class)]
class Film
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('film')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('film')]
    private $titre;

    #[ORM\Column(type: 'string', length: 4, nullable: true)]
    private $annee_sortie;

    #[ORM\Column(type: 'text', nullable: true)]
    private $synopsis;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $affiche;

    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'films_realises', fetch: 'EAGER')]
    #[ORM\JoinTable(name: 'film_personne_realisateur')]
    private $realisateurs;

    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'films_produits', fetch: 'EAGER')]
    #[ORM\JoinTable(name: 'film_personne_producteur')]
    private $producteurs;

    #[ORM\ManyToMany(targetEntity: Personne::class, inversedBy: 'films_joues', fetch: 'EAGER')]
    #[ORM\JoinTable(name: 'film_personne_acteur')]
    private $acteurs;

    #[ORM\ManyToMany(targetEntity: Categorie::class, mappedBy: 'films', fetch: 'EAGER')]
    private $categories;

    #[ORM\OneToMany(mappedBy: 'film', targetEntity: EmpruntFilm::class)]
    private $emprunt;

    public function __construct()
    {
        $this->realisateurs = new ArrayCollection();
        $this->producteurs = new ArrayCollection();
        $this->acteurs = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->emprunt = new ArrayCollection();
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

    public function getAnneeSortie(): ?string
    {
        return $this->annee_sortie;
    }

    public function setAnneeSortie(?string $annee_sortie): self
    {
        $this->annee_sortie = $annee_sortie;

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

    public function getAffiche(): ?string
    {
        return $this->affiche;
    }

    public function setAffiche(?string $affiche): self
    {
        $this->affiche = $affiche;

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
     * @return Collection<int, Personne>
     */
    public function getProducteurs(): Collection
    {
        return $this->producteurs;
    }

    public function addProducteur(Personne $producteur): self
    {
        if (!$this->producteurs->contains($producteur)) {
            $this->producteurs[] = $producteur;
        }

        return $this;
    }

    public function removeProducteur(Personne $producteur): self
    {
        $this->producteurs->removeElement($producteur);

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
            $category->addFilm($this);
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeFilm($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, EmpruntFilm>
     */
    public function getEmprunt(): Collection
    {
        return $this->emprunt;
    }

    public function addEmprunt(EmpruntFilm $emprunt): self
    {
        if (!$this->emprunt->contains($emprunt)) {
            $this->emprunt[] = $emprunt;
            $emprunt->setFilm($this);
        }

        return $this;
    }

    public function removeEmprunt(EmpruntFilm $emprunt): self
    {
        if ($this->emprunt->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getFilm() === $this) {
                $emprunt->setFilm(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getTitre();
    }
}
