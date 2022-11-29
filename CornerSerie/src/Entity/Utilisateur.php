<?php

namespace App\Entity;



use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: EmpruntFilm::class)]
    private $empruntFilms;

    #[ORM\OneToMany(mappedBy: 'utilisateur', targetEntity: EmpruntSerieSaison::class)]
    private $empruntSerieSaisons;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    public function __construct()
    {
        $this->empruntFilms = new ArrayCollection();
        $this->empruntSerieSaisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, EmpruntFilm>
     */
    public function getEmpruntFilms(): Collection
    {
        return $this->empruntFilms;
    }

    public function addEmpruntFilm(EmpruntFilm $empruntFilm): self
    {
        if (!$this->empruntFilms->contains($empruntFilm)) {
            $this->empruntFilms[] = $empruntFilm;
            $empruntFilm->setUtilisateur($this);
        }

        return $this;
    }

    public function removeEmpruntFilm(EmpruntFilm $empruntFilm): self
    {
        if ($this->empruntFilms->removeElement($empruntFilm)) {
            // set the owning side to null (unless already changed)
            if ($empruntFilm->getUtilisateur() === $this) {
                $empruntFilm->setUtilisateur(null);
            }
        }

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
            $empruntSerieSaison->setUtilisateur($this);
        }

        return $this;
    }

    public function removeEmpruntSerieSaison(EmpruntSerieSaison $empruntSerieSaison): self
    {
        if ($this->empruntSerieSaisons->removeElement($empruntSerieSaison)) {
            // set the owning side to null (unless already changed)
            if ($empruntSerieSaison->getUtilisateur() === $this) {
                $empruntSerieSaison->setUtilisateur(null);
            }
        }

        return $this;
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

    public function __toString(): string
    {
        return $this->getPrenom().' '.$this->getNom();
    }
}
