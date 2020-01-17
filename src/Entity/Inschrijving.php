<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InschrijvingRepository")
 */
class Inschrijving
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Les")
     * @ORM\JoinColumn(nullable=false)
     */
    private $les;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Lid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?bool
    {
        return $this->payment;
    }

    public function setPayment(?bool $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getLes(): ?Les
    {
        return $this->les;
    }

    public function setLes(?Les $les): self
    {
        $this->les = $les;

        return $this;
    }

    public function getLid(): ?User
    {
        return $this->Lid;
    }

    public function setLid(?User $Lid): self
    {
        $this->Lid = $Lid;

        return $this;
    }
}
