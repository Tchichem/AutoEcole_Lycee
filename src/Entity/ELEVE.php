<?php

namespace App\Entity;

use App\Repository\ELEVERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ELEVERepository::class)]
class ELEVE
{

    #[ORM\Id]
    #[ORM\Column]
    private ?int $id_eleve = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_eleve = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_eleve = null;

    #[ORM\Column]
    private ?bool $code = null;

    #[ORM\Column]
    private ?bool $conduite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_naissance_eleve = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_inscription = null;

    /**
     * @var Collection<int, LECON>
     */
    #[ORM\OneToMany(targetEntity: LECON::class, mappedBy: 'lecon_eleve_id')]
    private Collection $lecons;

    public function __construct()
    {
        $this->lecons = new ArrayCollection();
    }

    public function getIdEleve(): ?int
    {
        return $this->id_eleve;
    }

    public function setIdEleve(int $id_eleve): static
    {
        $this->id_eleve = $id_eleve;

        return $this;
    }

    public function getNomEleve(): ?string
    {
        return $this->nom_eleve;
    }

    public function setNomEleve(string $nom_eleve): static
    {
        $this->nom_eleve = $nom_eleve;

        return $this;
    }

    public function getPrenomEleve(): ?string
    {
        return $this->prenom_eleve;
    }

    public function setPrenomEleve(string $prenom_eleve): static
    {
        $this->prenom_eleve = $prenom_eleve;

        return $this;
    }

    public function isCode(): ?bool
    {
        return $this->code;
    }

    public function setCode(bool $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function isConduite(): ?bool
    {
        return $this->conduite;
    }

    public function setConduite(bool $conduite): static
    {
        $this->conduite = $conduite;

        return $this;
    }

    public function getDateNaissanceEleve(): ?\DateTime
    {
        return $this->date_naissance_eleve;
    }

    public function setDateNaissanceEleve(\DateTime $date_naissance_eleve): static
    {
        $this->date_naissance_eleve = $date_naissance_eleve;

        return $this;
    }

    public function getDateInscription(): ?\DateTime
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTime $date_inscription): static
    {
        $this->date_inscription = $date_inscription;

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
            $lecon->setLeconEleveId($this);
        }

        return $this;
    }

    public function removeLecon(LECON $lecon): static
    {
        if ($this->lecons->removeElement($lecon)) {
            // set the owning side to null (unless already changed)
            if ($lecon->getLeconEleveId() === $this) {
                $lecon->setLeconEleveId(null);
            }
        }

        return $this;
    }
}
