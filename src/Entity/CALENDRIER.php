<?php

namespace App\Entity;

use App\Repository\CALENDRIERRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CALENDRIERRepository::class)]
class CALENDRIER
{
    #[ORM\Id]
    #[ORM\Column]
    private ?\DateTime $date_heure = null;

    /**
     * @var Collection<int, LECON>
     */
    #[ORM\OneToMany(targetEntity: LECON::class, mappedBy: 'lecon_date_heure')]
    private Collection $lecons;

    public function __construct()
    {
        $this->lecons = new ArrayCollection();
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->date_heure;
    }

    public function setDateHeure(\DateTime $date_heure): static
    {
        $this->date_heure = $date_heure;

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
            $lecon->setLeconDateHeure($this);
        }

        return $this;
    }

    public function removeLecon(LECON $lecon): static
    {
        if ($this->lecons->removeElement($lecon)) {
            // set the owning side to null (unless already changed)
            if ($lecon->getLeconDateHeure() === $this) {
                $lecon->setLeconDateHeure(null);
            }
        }

        return $this;
    }
}
