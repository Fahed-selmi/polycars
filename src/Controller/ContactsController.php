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
use App\Entity\Clients;
use App\Entity\Agents;
use App\Entity\ImageUser;

/**
 * @Route("/contacts")
 */
class ContactsController extends AbstractController
{
    /**
     * @Route("/", name="contacts_index")
     */
    public function index()
    {
        $agents = $this->getDoctrine()->getRepository(Agents::class)->findAll();
        return $this->render('contacts/index.html.twig',[
            'agents'=>$agents
        ]);
    }

    /**
     * @Route("/add", name="contacts_add")
     */
    public function indexAdd(Request $request, string $uploadDir, 
             FileUploader $uploader, LoggerInterface $logger)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->get("nom") != null) {
            $nom = $request->get("nom");
            $prenom = $request->get("prenom");
            $email = $request->get("email");
            $cin = $request->get("cin");
            $tel = $request->get("tel");
            $permis = $request->get("nPermis");
            $role = $request->get("role");
            $dateN = $request->get("dateN");
            $permis_img = $request->get("permis_img");
            

            $agent = new Agents();
            $agent->setNom($nom);
            $agent->setPrenom($prenom);
            $agent->setEmail($email);
            $agent->setCin($cin);
            $agent->setTel($tel);
            $agent->setPremis($permis);
            $agent->setDateN( new \DateTime ($dateN));
            $agent->setRole($role);

            $em->persist($agent);
            $em->flush();
            
            return $this->redirectToRoute('contacts_index');
        }else{
            return $this->redirectToRoute('contacts_index');
        }
    }

    /**
     * @Route("/remove", name="contacts_remove")
     */
    public function indexRemove(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->get("id") != null){
            $id = $request->get("id");
            $agent = $em->getRepository(Agents::class)->find($id);
            $em->remove($agent);
            $em->flush();
        }
        return $this->redirectToRoute('contacts_index');
    }

    /**
     * @Route("/edit", name="contacts_edit")
     */
    public function indexEdit(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //if ($request->get("id") != null){
            $id = $request->get("id");
            $agent = $em->getRepository(Agents::class)->find($id);

            $nom = $request->get("nom");
            $prenom = $request->get("prenom");
            $email = $request->get("email");
            $cin = $request->get("cin");
            $tel = $request->get("tel");
            $role = $request->get("role");
            $dateN = $request->get("dateN");
            $permis_img = $request->get("permis_img");
            

            $agent->setNom($nom);
            $agent->setPrenom($prenom);
            $agent->setEmail($email);
            $agent->setCin($cin);
            $agent->setTel($tel);
            $agent->setPremis(123456);
            $agent->setDateN( new \DateTime ($dateN));
            $agent->setRole($role);

            $em->persist($agent);
            $em->flush();
            
        //}
        return $this->redirectToRoute('contacts_index');
    }

    /**
     * @Route("/clients", name="clients_index")
     */
    public function indexClients(Request $request)
    {    	
    	$em = $this->getDoctrine()->getManager();

    	if ($request->get("nom") != null) {
			$nom = $request->get("nom");
	    	$prenom = $request->get("prenom");
	    	$email = $request->get("email");
	    	$cin = $request->get("cin");
	    	$tel = $request->get("tel");

    		if ($request->get("id") != null) {
    			$id = $request->get("id");
    			$client = $em->getRepository(Clients::class)->find($id);

    			$client->setNom($nom);
    			$client->setPrenom($prenom);
    			$client->setEmail($email);
    			$client->setCin($cin);
    			$client->setNumTel($tel);

    			$em->persist($client);
				$em->flush();
    		}else{
    			$client = new Clients();

    			$client->setNom($nom);
    			$client->setPrenom($prenom);
    			$client->setEmail($email);
    			$client->setCin($cin);
    			$client->setNumTel($tel);

    			$em->persist($client);
				$em->flush();
    		}
    	}


    	$clients = $this->getDoctrine()->getRepository(Clients::class)->findAll();
        return $this->render('contacts/clients.html.twig',
		['clients'=>$clients]
		);
    }

    /**
     * @Route("/clients/load", name="clients_load")
     */
    public function indexClientsLoad()
    {   
        $clients = $this->getDoctrine()->getRepository(Clients::class)->findAll();
        return $this->render('contacts/datatable.html.twig',
        ['clients'=>$clients]
        );
    }

    /**
     * @Route("/clients/remove", name="clients_remove")
     */
    public function indexClientsRemove(Request $request)
    {   
    	$em = $this->getDoctrine()->getManager();
    	if ($request->get("id") != null) {
			$id = $request->get("id");
			$client = $em->getRepository(Clients::class)->find($id);

			$em->remove($client);
   			$em->flush();
   			return new Response("Supprimé avec succé");
		}        
        
    }
}
