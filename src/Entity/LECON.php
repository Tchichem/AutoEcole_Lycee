<?php

namespace App\Entity;

use App\Repository\LECONRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LECONRepository::class)]
class LECON
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    #[ORM\JoinColumn(name: 'calendrier_id', referencedColumnName: 'id', nullable: false)]
    private ?CALENDRIER $lecon_date_heure = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    #[ORM\JoinColumn(name: 'lecon_eleve_id', referencedColumnName: 'id_eleve', nullable: false)]
    private ?ELEVE $lecon_eleve_id = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    #[ORM\JoinColumn(name: 'lecon_modele_vehic', referencedColumnName: 'modele_vehic', nullable: false)]
    private ?MODELE $lecon_modele_vehic = null;

    #[ORM\ManyToOne(inversedBy: 'lecons')]
    #[ORM\JoinColumn(name: 'lecon_moniteur_id', referencedColumnName: 'id_moniteur', nullable: false)]
    private ?MONITEUR $lecon_moniteur_id = null;

    #[ORM\Column(type: 'string', length: 19, name: 'lecon_date_heure')]
    private ?string $leconDateHeureRaw = null;

    public function getIdLecon(): ?int
    {
        return $this->id;
    }

    public function setIdLecon(int $new_id): static
    {
        $this->id = $new_id;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getLeconDateHeureRaw(): ?string 
    { 
        return $this->leconDateHeureRaw; 
    }
    public function setLeconDateHeureRaw(string $d): static 
    { 
        $this->leconDateHeureRaw = $d; 
        return $this; 
    }

    public function getLeconDateHeure(): ?CALENDRIER
    {
        return $this->lecon_date_heure;
    }

    public function setLeconDateHeure(?CALENDRIER $lecon_date_heure): static
    {
        $this->lecon_date_heure = $lecon_date_heure;

        return $this;
    }

    public function getLeconEleveId(): ?ELEVE
    {
        return $this->lecon_eleve_id;
    }

    public function setLeconEleveId(?ELEVE $lecon_eleve_id): static
    {
        $this->lecon_eleve_id = $lecon_eleve_id;

        return $this;
    }

    public function getLeconModeleVehic(): ?MODELE
    {
        return $this->lecon_modele_vehic;
    }

    public function setLeconModeleVehic(?MODELE $lecon_modele_vehic): static
    {
        $this->lecon_modele_vehic = $lecon_modele_vehic;

        return $this;
    }

    public function getLeconMoniteurId(): ?MONITEUR
    {
        return $this->lecon_moniteur_id;
    }

    public function setLeconMoniteurId(?MONITEUR $lecon_moniteur_id): static
    {
        $this->lecon_moniteur_id = $lecon_moniteur_id;

        return $this;
    }
}
