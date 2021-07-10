<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Vehicule;
use App\Entity\VisiteEtAssurance;
use App\Repository\VisiteEtAssuranceRepository;
use App\Service\NotifService;

/**
 * @Route("/reminders")
 */
class RemindersController extends AbstractController
{
    /**
     * @Route("/", name="reminders_index")
     */
    public function index(NotifService $notif)
    {
    	$tech = $this->getDoctrine()->getRepository(VisiteEtAssurance::class)->findAll();
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        return $this->render('reminders/index.html.twig', [
            'tech' => $tech,
            'vehicule' => $vehicule,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="reminders_edit")
     */
    public function indexEdit(Request $request,$id)
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
			return $this->redirectToRoute('reminders_index');
		}

        return $this->redirectToRoute('reminders_index');
    }
}

