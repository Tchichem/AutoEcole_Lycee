<?php

namespace App\Entity;

use App\Repository\MONITEURRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MONITEURRepository::class)]
class MONITEUR
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id_moniteur = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_moniteur = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_moniteur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_naissance_moniteur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_embauche = null;

    #[ORM\Column]
    private ?bool $activite = null;

    /**
     * @var Collection<int, LECON>
     */
    #[ORM\OneToMany(targetEntity: LECON::class, mappedBy: 'lecon_moniteur_id')]
    private Collection $lecons;

    public function __construct()
    {
        $this->lecons = new ArrayCollection();
    }

    public function getIdMoniteur(): ?int
    {
        return $this->id_moniteur;
    }

    public function setIdMoniteur(int $id_moniteur): static
    {
        $this->id_moniteur = $id_moniteur;

        return $this;
    }

    public function getNomMoniteur(): ?string
    {
        return $this->nom_moniteur;
    }

    public function setNomMoniteur(string $nom_moniteur): static
    {
        $this->nom_moniteur = $nom_moniteur;

        return $this;
    }

    public function getPrenomMoniteur(): ?string
    {
        return $this->prenom_moniteur;
    }

    public function setPrenomMoniteur(string $prenom_moniteur): static
    {
        $this->prenom_moniteur = $prenom_moniteur;

        return $this;
    }

    public function getDateNaissanceMoniteur(): ?\DateTime
    {
        return $this->date_naissance_moniteur;
    }

    public function setDateNaissanceMoniteur(\DateTime $date_naissance_moniteur): static
    {
        $this->date_naissance_moniteur = $date_naissance_moniteur;

        return $this;
    }

    public function getDateEmbauche(): ?\DateTime
    {
        return $this->date_embauche;
    }

    public function setDateEmbauche(\DateTime $date_embauche): static
    {
        $this->date_embauche = $date_embauche;

        return $this;
    }

    public function isActivite(): ?bool
    {
        return $this->activite;
    }

    public function setActivite(bool $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    /**
     * @return Collection<int, LECON>
     */
    public function getLecons(): Collection
    {
        return $this->lecons;
    }

    public function addLecon(LECON $lecon): static
    {
        if (!$this->lecons->contains($lecon)) {
            $this->lecons->add($lecon);
            $lecon->setLeconMoniteurId($this);
        }

        return $this;
    }

    public function removeLecon(LECON $lecon): static
    {
        if ($this->lecons->removeElement($lecon)) {
            // set the owning side to null (unless already changed)
            if ($lecon->getLeconMoniteurId() === $this) {
                $lecon->setLeconMoniteurId(null);
            }
        }

        return $this;
    }
}
