<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Besoinlogistique;
use App\Entity\Designation;
use App\Repository\DesignationRepository;
use App\Repository\BesoinlogistiquenRepository;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\User\User;

class ArchiveController extends AbstractController
{
    /**
     * @Route("/archive", name="archive")
     */
    public function index()
    {
        
    }
	
	/**
     * @Route("/archive/bl", name="archive_bl")
     */
    public function indexBl()
    {	
		$bl = $this->getDoctrine()->getRepository(Besoinlogistique::class)->findAll();
        return $this->render('archive/bl.html.twig',
		['bl'=>$bl]
		);
    }
	
	/**
     * @Route("/archive/bl/b-{id}", name="archive_bl_open")
     */
    public function indexBlOpen($id)
    {	
		$em = $this->getDoctrine()->getManager();
		$bl = $this->getDoctrine()->getRepository(Besoinlogistique::class)->findOneById($id);
		$des = $this->getDoctrine()->getRepository(Designation::class)->findByIdBesoin($id);
        return $this->render('archive/bl-open.html.twig',[
		 'bl'=>$bl,
		 'des'=>$des
		]);
    }
	
	/**
     * @Route("/archive/bl/valid-{id}", name="archive_bl_validate")
     */
    public function indexBlValidate($id)
    {	
		$em = $this->getDoctrine()->getManager();
		$bl = $this->getDoctrine()->getRepository(Besoinlogistique::class)->findOneById($id);
		$bl->setEtat('Vérifié');
		$em->persist($bl);
		$em->flush();
		return new Response("Fichier validé avec succé");
    }


    /**
     * @Route("/archive/bl/load", name="archive_bl_load")
     */
    public function indexBlLoad()
    {   
        $bl = $this->getDoctrine()->getRepository(Besoinlogistique::class)->findAll();
        return $this->render('archive/datatable.html.twig',
        ['bl'=>$bl]
        );
    }
}
