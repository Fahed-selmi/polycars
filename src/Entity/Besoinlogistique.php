<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Besoinlogistique
 *
 * @ORM\Table(name="besoinlogistique")
 * @ORM\Entity
 */
class Besoinlogistique
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
     * @var string
     *
     * @ORM\Column(name="nom_demendeur", type="string", length=25, nullable=false)
     */
    private $nomDemendeur;

    /**
     * @var string
     *
     * @ORM\Column(name="num_demendeur", type="string", length=25, nullable=false)
     */
    private $numDemendeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_b", type="date", nullable=false)
     */
    private $dateB;

    /**
     * @var string
     *
     * @ORM\Column(name="site_dep", type="string", length=25, nullable=false)
     */
    private $siteDep;

    /**
     * @var string
     *
     * @ORM\Column(name="site_des", type="string", length=25, nullable=false)
     */
    private $siteDes;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=25, nullable=false)
     */
    private $etat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDemendeur(): ?string
    {
        return $this->nomDemendeur;
    }

    public function setNomDemendeur(string $nomDemendeur): self
    {
        $this->nomDemendeur = $nomDemendeur;

        return $this;
    }

    public function getNumDemendeur(): ?string
    {
        return $this->numDemendeur;
    }

    public function setNumDemendeur(string $numDemendeur): self
    {
        $this->numDemendeur = $numDemendeur;

        return $this;
    }

    public function getDateB(): ?\DateTimeInterface
    {
        return $this->dateB;
    }

    public function setDateB(\DateTimeInterface $dateB): self
    {
        $this->dateB = $dateB;

        return $this;
    }

    public function getSiteDep(): ?string
    {
        return $this->siteDep;
    }

    public function setSiteDep(string $siteDep): self
    {
        $this->siteDep = $siteDep;

        return $this;
    }

    public function getSiteDes(): ?string
    {
        return $this->siteDes;
    }

    public function setSiteDes(string $siteDes): self
    {
        $this->siteDes = $siteDes;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}
