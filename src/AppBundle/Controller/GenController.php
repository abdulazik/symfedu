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
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;



class GenController extends Controller
{
    /**
     * @Route("/gen")
     */
    public function multiformAction(Request $request)
    {
		$dateY = date('Y-m-d');
		$dateH = date('H:i:s');
		$date = $dateY.$dateH;
		$picHash = md5($date);
		
		
	if(!isset($_POST['code'])){
			$code = 'Aziz';
			
			$qrCode = new QrCode($code);
			$outputHash = 'Aziz';
			header('Content-Type: '.$qrCode->getContentType());
			$resultCode = $qrCode;
			$path = $this->get('kernel')->getRootDir() . '/../web/images';
			$qrCode->writeFile($path.'/'.$outputHash.'.png'); 
	}
	else{
			$code = $_POST['code'];
			$qrCode = new QrCode($code);

			header('Content-Type: '.$qrCode->getContentType());
			$resultCode = $qrCode;
			$code = $_POST['code'];
			$outputHash = $picHash;
			$path = $this->get('kernel')->getRootDir() . '/../web/images';
			$qrCode->writeFile($path.'/'.$outputHash.'.png'); 
			
			if($code != 'Aziz'){
				$em = $this->getDoctrine()->getManager();

				$qrcode1 = new Qrcode1();
				$qrcode1->setDate($dateY);
				$qrcode1->setTime($dateH);
				$qrcode1->setName($picHash);

				// tells Doctrine you want to (eventually) save the Product (no queries yet)
				$em->persist($qrcode1);

				// actually executes the queries (i.e. the INSERT query)
				$em->flush();
			}
			else{
				
			}
		
	}
	
	$pathToQr = '/qr/web/images/'.$outputHash.'.png';
        
	return $this->render('default/qr.html.twig', array(
			'pathToQr' => $pathToQr,
			'outputHash' => $outputHash,
        ));
		
    }
}
