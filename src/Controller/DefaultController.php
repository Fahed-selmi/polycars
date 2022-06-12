<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use App\Entity\Besoinlogistique;
use App\Entity\Designation;
use App\Entity\PolyGardeUser;
use App\Entity\Clients;
use App\Entity\Vehicule;
use App\Entity\VisiteEtAssurance;
use App\Entity\Mpreventive;
use App\Repository\VisiteEtAssuranceRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default_index")
     */
    public function index()
    {
    	$vCount = count($this->getDoctrine()->getRepository(Vehicule::class)->findByStatus("En Panne"));

    	$today = new \DateTime();
    	$week = new \DateTime();
    	$week->modify("+7 day");
    	$em = $this->getDoctrine()->getManager();

        $queryL = $em->createQuery('
            SELECT v 
            FROM App\Entity\VisiteEtAssurance v
            WHERE v.dateLeasing BETWEEN :today AND :week
            ORDER BY v.dateLeasing ASC
        ')->setParameter('today',$today)->setParameter('week',$week);
        $countL = count($queryL->getResult());
        $leasing = $queryL->getResult();

        $queryV = $em->createQuery('
            SELECT v 
            FROM App\Entity\VisiteEtAssurance v
            WHERE v.dateExpvisite BETWEEN :today AND :week
            ORDER BY v.dateExpvisite ASC
        ')->setParameter('today',$today)->setParameter('week',$week);
        $countV = count($queryV->getResult());
        $visite = $queryV->getResult();

        $queryA = $em->createQuery('
            SELECT v 
            FROM App\Entity\VisiteEtAssurance v
            WHERE v.dateExpassurance BETWEEN :today AND :week
            ORDER BY v.dateExpassurance ASC
        ')->setParameter('today',$today)->setParameter('week',$week);
        $countA = count($queryA->getResult());
        $assurance = $queryA->getResult();

        $techCount = $countL+$countV+$countA;

        return $this->render('default/index.html.twig', [
            'techCount' => $techCount,
            'leasing' => $leasing,
            'visite' => $visite,
            'assurance' => $assurance,
            'vCount' => $vCount,
        ]);
    }
	
	/**
     * @Route("/new/bl", name="default_new_bl")
     */
    public function indexForms(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$clients = $em->getRepository(Clients::class)->findAll();
		if($request->get("form_bl") != null){
			
			$nom_demandeur = $request->get("nom_demandeur");
			$num_demandeur = $request->get("num_demandeur");
			$date_besoin = new \DateTime ($request->get("date_besoin"));
			$site_dep = $request->get("site_dep");
			$site_des = $request->get("site_des");
			
			$bl = new Besoinlogistique();
			$bl->setNomDemendeur($nom_demandeur);
			$bl->setNumDemendeur($num_demandeur);
			$bl->setDateB($date_besoin);
			$bl->setSiteDep($site_dep);
			$bl->setSiteDes($site_des);
			$bl->setEtat("En Attente");
			$em->persist($bl);
			$em->flush();
			
			$total = count($request->get("nature"));
			$nature = $request->get("nature");
			$nb_pers = $request->get("nb_pers");
			$date_dep = $request->get("date_dep");
			$date_arr =  $request->get("date_arr");
			
			$idB = $bl->getId();
			
			
			foreach($nature as $key => $n){
				//echo $n;
				$desig = new Designation();
				$desig->setNature($n);
				$desig->setNbPers($nb_pers[$key]);
				$desig->setDateDep( new \DateTime ($date_dep[$key]));
				$desig->setDateArr(new \DateTime ($date_arr[$key]));
				$desig->setIdBesoin($bl);
				$desig->setNumDes("1");
				$em->persist($desig);
				$em->flush();
			}
			
			$this->addFlash('BlAdded', 'Ajouté avec succés');
			return $this->redirectToRoute('archive_bl');
		}
        return $this->render('default/new-bl.html.twig',
		['clients'=>$clients]
		);
    }
	
	/**
     * @Route("/user-update/{id}", name="user_update")
     */
    public function indexUser($id, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
		$em = $this->getDoctrine()->getManager();
		
		$nom = $request->get("nom");
		$prenom = $request->get("prenom");
		$email = $request->get("email");
		$cin = $request->get("cin");
		$tel = $request->get("tel");
		$pass = $request->get("password");
		
		$user = $em->getRepository(PolyGardeUser::class)->find($id);
		
		$password = $passwordEncoder->encodePassword(
		$user, 
		$pass);
		
		$user->setNom($nom);
		$user->setPrenom($prenom);
		$user->setEmail($email);
		$user->setCin($cin);
		$user->setTel($tel);
		$user->setPassword($password);
		
		//$em->flush();
		
		$this->addFlash('success', 'Utilisateur modifié avec succés');
        return $this->redirectToRoute('logout');
    }

    /**
     * @Route("/setting", name="setting")
     */
    public function indexSetting()
    {
		
		$maintenance = $this->getDoctrine()->getRepository(Mpreventive::class)->findAll();
		return $this->render('default/setting.html.twig',
			['maintenance'=>$maintenance]
		);
    }

    /**
     * @Route("/setting/update-preventive", name="preventive-edit")
     */
    public function EditPreventive(Request $request)
    {
		
		
		$em = $this->getDoctrine()->getManager();

		$km1 = $request->get("km1");
		$fh1 = $request->get("fh1");
		$fg1 = $request->get("fg1");
		$fa1 = $request->get("fa1");
		$h1 = $request->get("h1");
		$r1 = $request->get("r1");
		$f1 = $request->get("f1");
		$c1 = $request->get("c1");
		$v1 = $request->get("v1");

		

		$id = $request->get("id");
		$km = $request->get("km");
		$fh = $request->get("fh");
		$fg = $request->get("fg");
		$fa = $request->get("fa");
		$h = $request->get("h");
		$r = $request->get("r");
		$f = $request->get("f");
		$c = $request->get("c");
		$v = $request->get("v");
		
		if(isset($id)){
			foreach($id as $key => $n){
				$maintenance = $this->getDoctrine()->getRepository(Mpreventive::class)->findOneById($n);
				$maintenance->setKm($km[$key]);
				$maintenance->setFiltreHuile($fh[$key]);
				$maintenance->setFiltreGasoil($fg[$key]);
				$maintenance->setFiltreAir($fa[$key]);
				$maintenance->setHuile($h[$key]);
				$maintenance->setRoue($r[$key]);
				$maintenance->setFrein($f[$key]);
				$maintenance->setChaine($c[$key]);
				$maintenance->setVisite($v[$key]);
				$em->persist($maintenance);
				$em->flush();
			}
		}

		if(isset($km1)){
			foreach($km1 as $key => $n){
				$m = new Mpreventive();
				$m->setKm($n);
				$m->setFiltreHuile($fh1[$key]);
				$m->setFiltreGasoil($fg1[$key]);
				$m->setFiltreAir($fa1[$key]);
				$m->setHuile($h1[$key]);
				$m->setRoue($r1[$key]);
				$m->setFrein($f1[$key]);
				$m->setChaine($c1[$key]);
				$m->setVisite($v1[$key]);
				$em->persist($m);
				$em->flush();
			}
		}
		
		return $this->redirectToRoute('setting');
    }
}
