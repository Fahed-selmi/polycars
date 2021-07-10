<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Vehicule;
use App\Entity\Mpreventive;
use App\Entity\VisiteEtAssurance;
use App\Repository\VisiteEtAssuranceRepository;

/**
 * @Route("/services")
 */
class ServicesController extends AbstractController
{
    /**
     * @Route("/", name="services_index")
     */
    public function index()
    {
    	
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('
            SELECT v.vNom,v.matricule,v.status,v.kilometres,m.km,m.filtreHuile,m.filtreGasoil,m.filtreAir,m.huile,m.roue,m.frein,m.chaine,m.visite
            FROM App\Entity\Vehicule v,
            App\Entity\Mpreventive m
            WHERE v.kilometres BETWEEN m.km-2000 AND m.km
        ');
        $mp = $query->getResult();
        return $this->render('services/index.html.twig', [
            'mp' => $mp,
        ]);
    }

    /**
     * @Route("/suivi", name="suivi_index")
     */
    public function indexSuivi()
    {
    	$tech = $this->getDoctrine()->getRepository(VisiteEtAssurance::class)->findAll();
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        return $this->render('Services/visite.html.twig', [
            'tech' => $tech,
            'vehicule' => $vehicule,
        ]);
    }

    /**
     * @Route("/suivi/edit/{id}", name="suivi_edit")
     */
    public function indexEditSuivi(Request $request,$id)
    {
    	$em = $this->getDoctrine()->getManager();
        $tech = $em->getRepository(VisiteEtAssurance::class)->find($id);

        $leasing = new \DateTime ( $request->get("dateLeasing"));
        $visite = new \DateTime ( $request->get("dateExpVisite"));
        $assurance = new \DateTime ( $request->get("dateExpAssurance"));
        $vehicule = $request->get("vehicule");

		if($vehicule != null){

			$tech->setDateLeasing($leasing);
			$tech->setDateExpvisite($visite);
            $tech->setDateExpassurance($assurance);
			//$tech->setVehicule($vehicule);
			$em->persist($tech);
			$em->flush();
			return $this->redirectToRoute('suivi_index');
		}

        return $this->redirectToRoute('suivi_index');
    }
}
