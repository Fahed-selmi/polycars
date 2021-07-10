<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Designation
 *
 * @ORM\Table(name="designation", indexes={@ORM\Index(name="id_besoin", columns={"id_besoin"})})
 * @ORM\Entity
 */
class Designation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_des", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDes;

    /**
     * @var string
     *
     * @ORM\Column(name="num_des", type="string", length=25, nullable=false)
     */
    private $numDes;

    /**
     * @var string
     *
     * @ORM\Column(name="nature", type="string", length=25, nullable=false)
     */
    private $nature;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_pers", type="integer", nullable=false)
     */
    private $nbPers;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_dep", type="date", nullable=false)
     */
    private $dateDep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arr", type="date", nullable=false)
     */
    private $dateArr;

    /**
     * @var \Besoinlogistique
     *
     * @ORM\ManyToOne(targetEntity="Besoinlogistique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_besoin", referencedColumnName="id")
     * })
     */
    private $idBesoin;

    public function getIdDes(): ?int
    {
        return $this->idDes;
    }

    public function getNumDes(): ?string
    {
        return $this->numDes;
    }

    public function setNumDes(string $numDes): self
    {
        $this->numDes = $numDes;

        return $this;
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getNbPers(): ?int
    {
        return $this->nbPers;
    }

    public function setNbPers(int $nbPers): self
    {
        $this->nbPers = $nbPers;

        return $this;
    }

    public function getDateDep(): ?\DateTimeInterface
    {
        return $this->dateDep;
    }

    public function setDateDep(\DateTimeInterface $dateDep): self
    {
        $this->dateDep = $dateDep;

        return $this;
    }

    public function getDateArr(): ?\DateTimeInterface
    {
        return $this->dateArr;
    }

    public function setDateArr(\DateTimeInterface $dateArr): self
    {
        $this->dateArr = $dateArr;

        return $this;
    }

    public function getIdBesoin(): ?Besoinlogistique
    {
        return $this->idBesoin;
    }

    public function setIdBesoin(?Besoinlogistique $idBesoin): self
    {
        $this->idBesoin = $idBesoin;

        return $this;
    }


}
