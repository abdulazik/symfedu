<?php

namespace AppBundle\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Qrcode1;
use AppBundle\Entity\lastGen;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;



class fetcherController extends Controller
{
    /**
     * @Route("/lastgen")
     */
	 
    public function multiformAction(Request $request)
    {
		
	$Qrcode1 = $this->getDoctrine()
        ->getRepository(Qrcode1::class)
        ->findAll();
	
	$lastPost = new lastGen();
	$lastOne = $lastPost->lastPost($Qrcode1, $num=0);
	$lastArray = $Qrcode1[$lastOne-1];
	print_r($lastArray);
	//print_r($Qrcode321[9]);
	//$pathToQr = '/qr/web/images/'.$outputHash.'.png';
        
	return $this->render('default/lastgen.html.twig', array(
			'Qrcode1' => $Qrcode1,
			'lastArray' => $lastArray,
        ));
    }
}
