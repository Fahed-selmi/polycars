<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inspection
 *
 * @ORM\Table(name="inspection", indexes={@ORM\Index(name="vehicule", columns={"vehicule"})})
 * @ORM\Entity
 */
class Inspection
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
     * @var int
     *
     * @ORM\Column(name="phone", type="integer", nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=1000, nullable=false)
     */
    private $commentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="tel", type="integer", nullable=false)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="kelm", type="string", length=25, nullable=false)
     */
    private $kelm;

    /**
     * @var bool
     *
     * @ORM\Column(name="carroussrie", type="boolean", nullable=false)
     */
    private $carroussrie;

    /**
     * @var bool
     *
     * @ORM\Column(name="pneu", type="boolean", nullable=false)
     */
    private $pneu;

    /**
     * @var bool
     *
     * @ORM\Column(name="frein", type="boolean", nullable=false)
     */
    private $frein;

    /**
     * @var bool
     *
     * @ORM\Column(name="fuiteHuile", type="boolean", nullable=false)
     */
    private $fuitehuile;

    /**
     * @var bool
     *
     * @ORM\Column(name="retroviseu", type="boolean", nullable=false)
     */
    private $retroviseu;

    /**
     * @var bool
     *
     * @ORM\Column(name="feu", type="boolean", nullable=false)
     */
    private $feu;

    /**
     * @var bool
     *
     * @ORM\Column(name="eauRadiateu", type="boolean", nullable=false)
     */
    private $eauradiateu;

    /**
     * @var bool
     *
     * @ORM\Column(name="niveauhuil", type="boolean", nullable=false)
     */
    private $niveauhuil;

    /**
     * @var bool
     *
     * @ORM\Column(name="roueSecour", type="boolean", nullable=false)
     */
    private $rouesecour;

    /**
     * @var bool
     *
     * @ORM\Column(name="cri", type="boolean", nullable=false)
     */
    private $cri;

    /**
     * @var bool
     *
     * @ORM\Column(name="ivmsGp", type="boolean", nullable=false)
     */
    private $ivmsgp;

    /**
     * @var bool
     *
     * @ORM\Column(name="climatiseur", type="boolean", nullable=false)
     */
    private $climatiseur;

    /**
     * @var bool
     *
     * @ORM\Column(name="proprete", type="boolean", nullable=false)
     */
    private $proprete;

    /**
     * @var bool
     *
     * @ORM\Column(name="boitePharmaci", type="boolean", nullable=false)
     */
    private $boitepharmaci;

    /**
     * @var bool
     *
     * @ORM\Column(name="triangleSignal", type="boolean", nullable=false)
     */
    private $trianglesignal;

    /**
     * @var bool
     *
     * @ORM\Column(name="cableRe", type="boolean", nullable=false)
     */
    private $cablere;

    /**
     * @var bool
     *
     * @ORM\Column(name="centure", type="boolean", nullable=false)
     */
    private $centure;

    /**
     * @var bool
     *
     * @ORM\Column(name="types", type="boolean", nullable=false)
     */
    private $types;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getKelm(): ?string
    {
        return $this->kelm;
    }

    public function setKelm(string $kelm): self
    {
        $this->kelm = $kelm;

        return $this;
    }

    public function getCarroussrie(): ?bool
    {
        return $this->carroussrie;
    }

    public function setCarroussrie(bool $carroussrie): self
    {
        $this->carroussrie = $carroussrie;

        return $this;
    }

    public function getPneu(): ?bool
    {
        return $this->pneu;
    }

    public function setPneu(bool $pneu): self
    {
        $this->pneu = $pneu;

        return $this;
    }

    public function getFrein(): ?bool
    {
        return $this->frein;
    }

    public function setFrein(bool $frein): self
    {
        $this->frein = $frein;

        return $this;
    }

    public function getFuitehuile(): ?bool
    {
        return $this->fuitehuile;
    }

    public function setFuitehuile(bool $fuitehuile): self
    {
        $this->fuitehuile = $fuitehuile;

        return $this;
    }

    public function getRetroviseu(): ?bool
    {
        return $this->retroviseu;
    }

    public function setRetroviseu(bool $retroviseu): self
    {
        $this->retroviseu = $retroviseu;

        return $this;
    }

    public function getFeu(): ?bool
    {
        return $this->feu;
    }

    public function setFeu(bool $feu): self
    {
        $this->feu = $feu;

        return $this;
    }

    public function getEauradiateu(): ?bool
    {
        return $this->eauradiateu;
    }

    public function setEauradiateu(bool $eauradiateu): self
    {
        $this->eauradiateu = $eauradiateu;

        return $this;
    }

    public function getNiveauhuil(): ?bool
    {
        return $this->niveauhuil;
    }

    public function setNiveauhuil(bool $niveauhuil): self
    {
        $this->niveauhuil = $niveauhuil;

        return $this;
    }

    public function getRouesecour(): ?bool
    {
        return $this->rouesecour;
    }

    public function setRouesecour(bool $rouesecour): self
    {
        $this->rouesecour = $rouesecour;

        return $this;
    }

    public function getCri(): ?bool
    {
        return $this->cri;
    }

    public function setCri(bool $cri): self
    {
        $this->cri = $cri;

        return $this;
    }

    public function getIvmsgp(): ?bool
    {
        return $this->ivmsgp;
    }

    public function setIvmsgp(bool $ivmsgp): self
    {
        $this->ivmsgp = $ivmsgp;

        return $this;
    }

    public function getClimatiseur(): ?bool
    {
        return $this->climatiseur;
    }

    public function setClimatiseur(bool $climatiseur): self
    {
        $this->climatiseur = $climatiseur;

        return $this;
    }

    public function getProprete(): ?bool
    {
        return $this->proprete;
    }

    public function setProprete(bool $proprete): self
    {
        $this->proprete = $proprete;

        return $this;
    }

    public function getBoitepharmaci(): ?bool
    {
        return $this->boitepharmaci;
    }

    public function setBoitepharmaci(bool $boitepharmaci): self
    {
        $this->boitepharmaci = $boitepharmaci;

        return $this;
    }

    public function getTrianglesignal(): ?bool
    {
        return $this->trianglesignal;
    }

    public function setTrianglesignal(bool $trianglesignal): self
    {
        $this->trianglesignal = $trianglesignal;

        return $this;
    }

    public function getCablere(): ?bool
    {
        return $this->cablere;
    }

    public function setCablere(bool $cablere): self
    {
        $this->cablere = $cablere;

        return $this;
    }

    public function getCenture(): ?bool
    {
        return $this->centure;
    }

    public function setCenture(bool $centure): self
    {
        $this->centure = $centure;

        return $this;
    }

    public function getTypes(): ?bool
    {
        return $this->types;
    }

    public function setTypes(bool $types): self
    {
        $this->types = $types;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
