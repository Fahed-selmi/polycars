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


}
