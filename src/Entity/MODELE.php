<?php

namespace App\Entity;

use App\Repository\MODELERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MODELERepository::class)]
class MODELE
{
    #[ORM\Id]
    #[ORM\Column(length: 50)]
    private ?string $modele_vehic = null;

    #[ORM\Column(length: 50)]
    private ?string $marque = null;

    #[ORM\Column(length: 4)]
    private ?string $annee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $date_achat = null;

    /**
     * @var Collection<int, VEHICULE>
     */
    #[ORM\OneToMany(targetEntity: VEHICULE::class, mappedBy: 'modele_vehic')]
    private Collection $vehicules;

    /**
     * @var Collection<int, LECON>
     */
    #[ORM\OneToMany(targetEntity: LECON::class, mappedBy: 'lecon_modele_vehic')]
    private Collection $lecons;

    public function __construct()
    {
        $this->vehicules = new ArrayCollection();
        $this->lecons = new ArrayCollection();
    }

    public function getModeleVehic(): ?string
    {
        return $this->modele_vehic;
    }

    public function setModeleVehic(string $modele_vehic): static
    {
        $this->modele_vehic = $modele_vehic;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDateAchat(): ?\DateTime
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTime $date_achat): static
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    /**
     * @return Collection<int, VEHICULE>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(VEHICULE $vehicule): static
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setModeleVehic($this);
        }

        return $this;
    }

    public function removeVehicule(VEHICULE $vehicule): static
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getModeleVehic() === $this) {
                $vehicule->setModeleVehic(null);
            }
        }

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
            $lecon->setLeconModeleVehic($this);
        }

        return $this;
    }

    public function removeLecon(LECON $lecon): static
    {
        if ($this->lecons->removeElement($lecon)) {
            // set the owning side to null (unless already changed)
            if ($lecon->getLeconModeleVehic() === $this) {
                $lecon->setLeconModeleVehic(null);
            }
        }

        return $this;
    }
}
