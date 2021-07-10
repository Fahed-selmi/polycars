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


}
