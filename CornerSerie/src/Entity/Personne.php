<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'realisateurs', fetch: 'EAGER')]
    private $films_realises;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'producteurs', fetch: 'EAGER')]
    private $films_produits;

    #[ORM\ManyToMany(targetEntity: Film::class, mappedBy: 'acteurs', fetch: 'EAGER')]
    private $films_joues;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'acteurs', fetch: 'EAGER')]
    private $series_jouees;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'realisateurs', fetch: 'EAGER')]
    private $series_realisees;

    public function __construct()
    {
        $this->films_realises = new ArrayCollection();
        $this->films_produits = new ArrayCollection();
        $this->films_joues = new ArrayCollection();
        $this->series_jouees = new ArrayCollection();
        $this->series_realisees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsRealises(): Collection
    {
        return $this->films_realises;
    }

    public function addFilmsRealise(Film $filmsRealise): self
    {
        if (!$this->films_realises->contains($filmsRealise)) {
            $this->films_realises[] = $filmsRealise;
            $filmsRealise->addRealisateur($this);
        }

        return $this;
    }

    public function removeFilmsRealise(Film $filmsRealise): self
    {
        if ($this->films_realises->removeElement($filmsRealise)) {
            $filmsRealise->removeRealisateur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsProduits(): Collection
    {
        return $this->films_produits;
    }

    public function addFilmsProduit(Film $filmsProduit): self
    {
        if (!$this->films_produits->contains($filmsProduit)) {
            $this->films_produits[] = $filmsProduit;
            $filmsProduit->addProducteur($this);
        }

        return $this;
    }

    public function removeFilmsProduit(Film $filmsProduit): self
    {
        if ($this->films_produits->removeElement($filmsProduit)) {
            $filmsProduit->removeProducteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmsJoues(): Collection
    {
        return $this->films_joues;
    }

    public function addFilmsJoue(Film $filmJoue): self
    {
        if (!$this->films_joues->contains($filmJoue)) {
            $this->films_joues[] = $filmJoue;
            $filmJoue->addActeur($this);
        }
        return $this;
    }

    public function removeFilmsJoue(Film $filmJoue): self
    {
        if($this->films_joues->removeElement($filmJoue)) {
            $filmJoue->removeActeur($this);
        }
        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSeriesJouese(): Collection
    {
        return $this->series_jouees;
    }

    public function addSeriesJouee(Serie $seriesJouee): self
    {
        if (!$this->series_jouees->contains($seriesJouee)) {
            $this->series_jouees[] = $seriesJouee;
            $seriesJouee->addActeur($this);
        }

        return $this;
    }

    public function removeSeriesJouee(Serie $seriesJouee): self
    {
        if ($this->series_jouees->removeElement($seriesJouee)) {
            $seriesJouee->removeActeur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSeriesRealisees(): Collection
    {
        return $this->series_realisees;
    }

    public function addSeriesRealisee(Serie $seriesRealisee): self
    {
        if (!$this->series_realisees->contains($seriesRealisee)) {
            $this->series_realisees[] = $seriesRealisee;
            $seriesRealisee->addRealisateur($this);
        }

        return $this;
    }

    public function removeSeriesRealisee(Serie $seriesRealisee): self
    {
        if ($this->series_realisees->removeElement($seriesRealisee)) {
            $seriesRealisee->removeRealisateur($this);
        }

        return $this;
    }

    public function __toString() : string
    {
        return $this->prenom.' '.$this->nom;
    }
}
