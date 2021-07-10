<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/issues")
 */
class IssuesController extends AbstractController
{
    /**
     * @Route("/", name="issues_index")
     */
    public function index()
    {
        return $this->render('issues/index.html.twig', [
            'controller_name' => 'IssuesController',
        ]);
    }
}
