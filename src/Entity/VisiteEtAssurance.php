<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VisiteEtAssurance
 *
 * @ORM\Table(name="visite_et_assurance", indexes={@ORM\Index(name="FK_3116C33A292FFF1D", columns={"vehicule"})})
 * @ORM\Entity
 */
class VisiteEtAssurance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_leasing", type="date", nullable=false)
     */
    private $dateLeasing;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expVisite", type="date", nullable=false)
     */
    private $dateExpvisite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_expAssurance", type="date", nullable=false)
     */
    private $dateExpassurance;

    /**
     * @var \Vehicule
     *
     * @ORM\ManyToOne(targetEntity="Vehicule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehicule", referencedColumnName="id")
     * })
     */
    private $vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLeasing(): ?\DateTimeInterface
    {
        return $this->dateLeasing;
    }

    public function setDateLeasing(\DateTimeInterface $dateLeasing): self
    {
        $this->dateLeasing = $dateLeasing;

        return $this;
    }

    public function getDateExpvisite(): ?\DateTimeInterface
    {
        return $this->dateExpvisite;
    }

    public function setDateExpvisite(\DateTimeInterface $dateExpvisite): self
    {
        $this->dateExpvisite = $dateExpvisite;

        return $this;
    }

    public function getDateExpassurance(): ?\DateTimeInterface
    {
        return $this->dateExpassurance;
    }

    public function setDateExpassurance(\DateTimeInterface $dateExpassurance): self
    {
        $this->dateExpassurance = $dateExpassurance;

        return $this;
    }

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }


}
