<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MpreventiveRepository")
 */
class Mpreventive
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
    private $km;

    /**
     * @ORM\Column(type="boolean")
     */
    private $filtreHuile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $filtreGasoil;

    /**
     * @ORM\Column(type="boolean")
     */
    private $filtreAir;

    /**
     * @ORM\Column(type="boolean")
     */
    private $huile;

    /**
     * @ORM\Column(type="boolean")
     */
    private $roue;

    /**
     * @ORM\Column(type="boolean")
     */
    private $frein;

    /**
     * @ORM\Column(type="boolean")
     */
    private $chaine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKm(): ?string
    {
        return $this->km;
    }

    public function setKm(string $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getFiltreHuile(): ?bool
    {
        return $this->filtreHuile;
    }

    public function setFiltreHuile(bool $filtreHuile): self
    {
        $this->filtreHuile = $filtreHuile;

        return $this;
    }

    public function getFiltreGasoil(): ?bool
    {
        return $this->filtreGasoil;
    }

    public function setFiltreGasoil(bool $filtreGasoil): self
    {
        $this->filtreGasoil = $filtreGasoil;

        return $this;
    }

    public function getFiltreAir(): ?bool
    {
        return $this->filtreAir;
    }

    public function setFiltreAir(bool $filtreAir): self
    {
        $this->filtreAir = $filtreAir;

        return $this;
    }

    public function getHuile(): ?bool
    {
        return $this->huile;
    }

    public function setHuile(bool $huile): self
    {
        $this->huile = $huile;

        return $this;
    }

    public function getRoue(): ?string
    {
        return $this->roue;
    }

    public function setRoue(string $roue): self
    {
        $this->roue = $roue;

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

    public function getChaine(): ?bool
    {
        return $this->chaine;
    }

    public function setChaine(bool $chaine): self
    {
        $this->chaine = $chaine;

        return $this;
    }

    public function getVisite(): ?bool
    {
        return $this->visite;
    }

    public function setVisite(bool $visite): self
    {
        $this->visite = $visite;

        return $this;
    }
}
