<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\MakerBundle\Generator;
//use SGK\BarcodeBundle\Generator\Generator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use App\Service\FileUploader;
use Psr\Log\LoggerInterface;

/**
 * @Route("/inspection")
 */
class InspectionController extends AbstractController
{
    /**
     * @Route("/", name="inspection_index")
     */
    public function index(string $uploadDir, 
             FileUploader $uploader, LoggerInterface $logger)
    {
    	$route = $this->generateUrl('vehicule_open',[
    		'id' => 3,
    	]);
    	$link = "localhost".$route;
    	$barcode = new \Com\Tecnick\Barcode\Barcode();
    	$obj = $barcode->getBarcodeObj(
    		'QRCODE,H',
    		$link,
    		-4,
    		-4,
    		'black',
    	)->setBackgroundColor('white');
    	$image = $obj->getPngData();
    	$time = "fahed";
    	file_put_contents($uploadDir."/".$time.'.png',$image);
        return $this->render('inspection/index.html.twig');
    }
}
