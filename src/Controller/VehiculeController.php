<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use App\Service\FileUploader;
use Psr\Log\LoggerInterface;
use App\Entity\Vehicule;
use App\Entity\Images;
use App\Entity\VisiteEtAssurance;
use App\Repository\ImagesRepository;
use App\Repository\VehiculeRepository;
/**
 * @Route("/vehicule")
 */
class VehiculeController extends AbstractController
{
    /**
     * @Route("/", name="vehicule_index")
     */
    public function index(Request $request, string $uploadDir, 
             FileUploader $uploader, LoggerInterface $logger)
    {
		$em = $this->getDoctrine()->getManager();
		if($request->get("vNom") != null){
			
			$nom = $request->get("vNom");
			$fabricant = $request->get("fabricant");
			$model = $request->get("model");
			$type = $request->get("type");
			$annee = $request->get("annee");
			$nombre = $request->get("nombre");
			$vin = $request->get("vin");
			$matricule = $request->get("matricule");
			$etat = $request->get("etat");
			$prix = $request->get("prix");
			$couleur = $request->get("couleur");
			$Roue = $request->get("Roue");
			$kilo = $request->get("kilo");
			$status = $request->get("status");
			$groupe = $request->get("groupe");
			$ownership = $request->get("ownership");
			$remarks = $request->get("remarks");
			
			$v = new Vehicule();
			$v->setVNom($nom);
			$v->setVin($vin);
			$v->setMatricule($matricule);
			$v->setType($type);
			$v->setAnnee($annee);
			$v->setMaker($fabricant);
			$v->setModel($model);
			$v->setPrix($prix);
			$v->setNbplace($nombre);
			$v->setEtatEnreg($etat);
			$v->setColeur($couleur);
			$v->setTypeRoue($Roue);
			$v->setStatus($status);
			$v->setGroupe($groupe);
			$v->setOwnership($ownership);
			$v->setDescription($remarks);
			$v->setKilometres($kilo);
			$em->persist($v);
			$em->flush();
			
			if (!file_exists('vehicules-pictures')) {
				mkdir('vehicules-pictures', 0777, true);
			}

			$file = $request->files->get('images');
			
			$route = $this->generateUrl('vehicule_open',[
    		'id' => $v->getId(),
	    	]);
	    	$barcode = new \Com\Tecnick\Barcode\Barcode();
	    	$obj = $barcode->getBarcodeObj(
	    		'QRCODE,H',
	    		$route,
	    		-4,
	    		-4,
	    		'black',
	    	)->setBackgroundColor('white');
	    	$image = $obj->getPngData();
	    	$qrcode = "QRCODE-".$model."-".$matricule.".png";
	    	file_put_contents($uploadDir."/".$qrcode,$image);
	    	$img = new Images();

			$img->setImage($qrcode);
			$img->setType("qrcode");
			$img->setVehicule($v);
			$em->persist($img);
			$em->flush();
	        /*if (empty($file)) 
	        {
	            return new Response("No file specified",  
	               Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
	        }  */      
	        //if ($numFile > 0) {
	       		foreach($file as $key => $n){
	        		$filename = 'new_'.$v->getId().'-'.$key.'.'.$n->guessExtension();
	        		// NAME : new_7-1.png
	        		// NAME : new_7-2.jpg
	        		// NAME : new_7-3.png
			        $uploader->upload($uploadDir, $n, $filename);

					$img = new Images();

					$img->setImage($filename);
					$img->setType("new");
					$img->setVehicule($v);
					$em->persist($img);
					$em->flush();
	        	}
	        //}
	        
			$leasing =  new \DateTime ($request->get('leasing'));
			$assurance =  new \DateTime ($request->get('assurance'));
			$visite =  new \DateTime ($request->get('visite'));
			$tech = new VisiteEtAssurance();
			$tech->setDateLeasing($leasing );
			$tech->setDateExpvisite($visite);
			$tech->setDateExpassurance($assurance);
			$tech->setVehicule($v);
			$em->persist($tech);
			$em->flush();

			$this->addFlash('vAdded', 'Vehicule ajouteé avec succés');
			return new Response("Vehicule ajouté avec succé");
			
		}
		
		$vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        return $this->render('vehicule/index.html.twig',
		['vehicule'=>$vehicule]
		);
    }  
	
	
	/**
     * @Route("/vl/{id}", name="vehicule_open")
     */
    public function indexOpen($id)
    {
		$em = $this->getDoctrine()->getManager();
		$v = $em->getRepository(Vehicule::class)->find($id);
		$img = $em->getRepository(Images::class)->findByVehicule($id);
		
		return $this->render('vehicule/open.html.twig',[
		'v'=>$v,
		'img'=>$img
		]);
    }
	

	/**
     * @Route("/checkV", name="vehicule_check")
     */
    public function indexCheck(Request $request)
    {
		//$em = $this->getDoctrine()->getManager();
		$nom = $request->get("vNom");
		$vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findByv_nom($nom);
		if ($vehicule==true) {
			$this->addFlash('vExists', 'Vehicule name already in use');
			return new Response("Vehicule name already in use");
		}
		else{
			$this->addFlash('vNotExists', 'Vehicule name not in use');
			return new Response("Vehicule name not in use");
		}	
    }
	
	
	/**
     * @Route("/remove-{id}", name="vehicule_remove")
     */
    public function indexRemove(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();
		$v = $em->getRepository(Vehicule::class)->find($id);
		$image = $em->getRepository(Images::class)->findByVehicule($id);
		foreach($image as $key => $im) {
			$em->remove($im);
			$em->flush();
		}
		$em->remove($v);
		$em->flush();
		
		$this->addFlash('vDeleted', 'Vehicule supprimé avec succés');
		return new Response("Vehicule supprimé avec succés");
    }
	
	/**
     * @Route("/edit/{id}", name="vehicule_edit")
     */
    public function indexEdit(Request $request, $id, string $uploadDir, 
             FileUploader $uploader, LoggerInterface $logger)
    {
		$em = $this->getDoctrine()->getManager();
		$v = $em->getRepository(Vehicule::class)->find($id);
		$img = $em->getRepository(Images::class)->findByVehicule($id);
		if($request->get("vNom") != null){
			
			$nom = $request->get("vNom");
			$fabricant = $request->get("fabricant");
			$model = $request->get("model");
			$type = $request->get("type");
			$annee = $request->get("annee");
			$nombre = $request->get("nombre");
			$vin = $request->get("vin");
			$matricule = $request->get("matricule");
			$etat = $request->get("etat");
			$prix = $request->get("prix");
			$couleur = $request->get("couleur");
			$Roue = $request->get("Roue");
			$kilo = $request->get("kilo");
			$status = $request->get("status");
			$groupe = $request->get("groupe");
			$ownership = $request->get("ownership");
			$images = $request->get("images");
			$remarks = $request->get("remarks");
			$image = $request->get("images");
			
			$v->setVNom($nom);
			$v->setVin($vin);
			$v->setMatricule($matricule);
			$v->setType($type);
			$v->setAnnee($annee);
			$v->setMaker($fabricant);
			$v->setModel($model);
			$v->setPrix($prix);
			$v->setNbplace($nombre);
			$v->setEtatEnreg($etat);
			$v->setColeur($couleur);
			$v->setTypeRoue($Roue);
			$v->setStatus($status);
			$v->setGroupe($groupe);
			$v->setOwnership($ownership);
			$v->setDescription($remarks);
			$v->setKilometres($kilo);
			$em->persist($v);
			$em->flush();
			
			if (!file_exists('vehicules-pictures')) {
				mkdir('vehicules-pictures', 0777, true);
			}

			$file = $request->files->get('images');
			
			//$numFile = count($request->files->get('images'));

	       /* if (empty($file)) 
	        {
	            return new Response("No file specified",  
	               Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
	        }      
	        if ($request->files->get('images')) {
	       		foreach($file as $key => $n){
	        		$filename = 'new_'.$v->getId().'-'.$key.'.'.$n->guessExtension();
			        $uploader->upload($uploadDir, $n, $filename);

					$img = new Images();

					$img->setImage($filename);
					$img->setType("new");
					$img->setVehicule($v);
					$em->persist($img);
					$em->flush();
	        	}
	        }*/

			$this->addFlash('vEdited', 'Vehicule modifié avec succés');
			return new Response("Vehicule modifié avec succés");
		}
		$vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
		return $this->render('vehicule/edit.html.twig',[
		'v'=>$v,
		'img'=>$img,
		'vehicule'=>$vehicule
		]);
    }
    
}
