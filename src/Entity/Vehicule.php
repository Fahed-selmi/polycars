<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
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
     * @ORM\Column(name="v_nom", type="string", length=255, nullable=false)
     */
    private $vNom;

    /**
     * @var string
     *
     * @ORM\Column(name="vin", type="string", length=255, nullable=false)
     */
    private $vin;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=255, nullable=false)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=255, nullable=false)
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="maker", type="string", length=255, nullable=false)
     */
    private $maker;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255, nullable=false)
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPlace", type="integer", nullable=false)
     */
    private $nbplace;

    /**
     * @var string
     *
     * @ORM\Column(name="etat_enreg", type="string", length=255, nullable=false)
     */
    private $etatEnreg;

    /**
     * @var string
     *
     * @ORM\Column(name="coleur", type="string", length=255, nullable=false)
     */
    private $coleur;

    /**
     * @var string
     *
     * @ORM\Column(name="type_roue", type="string", length=255, nullable=false)
     */
    private $typeRoue;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", length=255, nullable=false)
     */
    private $groupe;

    /**
     * @var string
     *
     * @ORM\Column(name="ownership", type="string", length=255, nullable=false)
     */
    private $ownership;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="kilometres", type="string", length=255, nullable=false)
     */
    private $kilometres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVNom(): ?string
    {
        return $this->vNom;
    }

    public function setVNom(string $vNom): self
    {
        $this->vNom = $vNom;

        return $this;
    }

    public function getVin(): ?string
    {
        return $this->vin;
    }

    public function setVin(string $vin): self
    {
        $this->vin = $vin;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getMaker(): ?string
    {
        return $this->maker;
    }

    public function setMaker(string $maker): self
    {
        $this->maker = $maker;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNbplace(): ?int
    {
        return $this->nbplace;
    }

    public function setNbplace(int $nbplace): self
    {
        $this->nbplace = $nbplace;

        return $this;
    }

    public function getEtatEnreg(): ?string
    {
        return $this->etatEnreg;
    }

    public function setEtatEnreg(string $etatEnreg): self
    {
        $this->etatEnreg = $etatEnreg;

        return $this;
    }

    public function getColeur(): ?string
    {
        return $this->coleur;
    }

    public function setColeur(string $coleur): self
    {
        $this->coleur = $coleur;

        return $this;
    }

    public function getTypeRoue(): ?string
    {
        return $this->typeRoue;
    }

    public function setTypeRoue(string $typeRoue): self
    {
        $this->typeRoue = $typeRoue;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    public function getOwnership(): ?string
    {
        return $this->ownership;
    }

    public function setOwnership(string $ownership): self
    {
        $this->ownership = $ownership;

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

    public function getKilometres(): ?string
    {
        return $this->kilometres;
    }

    public function setKilometres(string $kilometres): self
    {
        $this->kilometres = $kilometres;

        return $this;
    }


}
