<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; 
use App\Repository\NotificationsRepository;
use App\Entity\Notifications;

class NotifService extends AbstractController
{
    public function list()
    {
    	$em = $this->getDoctrine()->getManager();
    	$notif = $em->getRepository(Notifications::class)->findAll();
    	//$notif = "test";
    	return $notif;
    }


} 