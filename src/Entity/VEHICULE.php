<?php

namespace App\Entity;

use App\Repository\VEHICULERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VEHICULERepository::class)]
class VEHICULE
{
    #[ORM\Id]
    #[ORM\Column(length: 9)]
    private ?string $num_immatric = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(name: 'modele_vehic', referencedColumnName: 'modele_vehic', nullable: false)]
    private ?MODELE $modele_vehic = null;

    #[ORM\Column]
    private ?bool $etat = null;

    public function getNumImmatric(): ?string
    {
        return $this->num_immatric;
    }

    public function setNumImmatric(string $num_immatric): static
    {
        $this->num_immatric = $num_immatric;

        return $this;
    }

    public function getModeleVehic(): ?MODELE
    {
        return $this->modele_vehic;
    }

    public function setModeleVehic(?MODELE $modele_vehic): static
    {
        $this->modele_vehic = $modele_vehic;

        return $this;
    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): static
    {
        $this->etat = $etat;

        return $this;
    }
}
