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




class GenController extends Controller
{
    /**
     * @Route("/gen")
     */
    public function multiformAction(Request $request)
    {
		
		if(!isset($_POST['code'])){
			$code = 'Aziz';
		}
		else{
		$code = $_POST['code'];
		}
		
        $qrCode = new QrCode($code);

	header('Content-Type: '.$qrCode->getContentType());
	$resultCode = $qrCode;
	$path = $this->get('kernel')->getRootDir() . '/../web/images';
	$qrCode->writeFile($path.'/qrcode.png'); 

	$form = $this->createFormBuilder()
            ->add('code', TextType::class)
            ->add('Generate', SubmitType::class)
            ->getForm();
	
	return $this->render('default/qr.html.twig', array(
            'form' => $form->createView(),
			'dir' => $dir,
        ));
    }
}
