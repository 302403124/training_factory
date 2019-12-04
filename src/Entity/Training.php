<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingRepository")
 */
class Training
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $costs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Les", mappedBy="training")
     */
    private $lessen;

    public function __construct()
    {
        $this->lessen = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCosts(): ?int
    {
        return $this->costs;
    }

    public function setCosts(?int $costs): self
    {
        $this->costs = $costs;

        return $this;
    }

    /**
     * @return Collection|Les[]
     */
    public function getLessen(): Collection
    {
        return $this->lessen;
    }

    public function addLessen(Les $lessen): self
    {
        if (!$this->lessen->contains($lessen)) {
            $this->lessen[] = $lessen;
            $lessen->setTraining($this);
        }

        return $this;
    }

    public function removeLessen(Les $lessen): self
    {
        if ($this->lessen->contains($lessen)) {
            $this->lessen->removeElement($lessen);
            // set the owning side to null (unless already changed)
            if ($lessen->getTraining() === $this) {
                $lessen->setTraining(null);
            }
        }

        return $this;
    }
}
