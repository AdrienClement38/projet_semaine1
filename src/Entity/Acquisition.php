<?php

namespace App\Entity;

use App\Repository\AcquisitionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AcquisitionRepository::class)]
class Acquisition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'acquisitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Address $address = null;

    #[ORM\OneToOne(mappedBy: 'acquisition', cascade: ['persist', 'remove'])]
    private ?Annonce $annonce = null;

    #[ORM\ManyToOne(inversedBy: 'acquisitions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?Annonce $annonce): self
    {
        // unset the owning side of the relation if necessary
        if ($annonce === null && $this->annonce !== null) {
            $this->annonce->setAcquisition(null);
        }

        // set the owning side of the relation if necessary
        if ($annonce !== null && $annonce->getAcquisition() !== $this) {
            $annonce->setAcquisition($this);
        }

        $this->annonce = $annonce;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
