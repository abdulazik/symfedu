<?php
namespace AppBundle\Entity;
use App\Entity\Task;
use AppBundle\Form\TaskType;
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

class session{
public function gen(Request $request)
    {
		if(isset($_POST['postname'])){
			$_SESSION['username'] = $_POST['postname'];
			$username = $_SESSION['username'];
		}
		if(isset($_SESSION['username'])){
		$dateY = date('Y-m-d');
		$dateH = date('H:i:s');
		$date = $dateY.$dateH;
		$picHash = md5($date);
		$username = $_SESSION['username'];
		
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
				$qrcode1->setUsername($_SESSION['username']);
				// tells Doctrine you want to (eventually) save the Product (no queries yet)
				$em->persist($qrcode1);

				// actually executes the queries (i.e. the INSERT query)
				$em->flush();
			}
			else{
				
			}
		
	}
	
	$pathToQr = '/qr/web/images/'.$outputHash.'.png';
	$_SESSION['pathToQr'] = $pathToQr;
	$_SESSION['outputHash'] = $outputHash;
	$authmes = 'Hello '.$_SESSION['username'];
        
	return $this->render('default/qr.html.twig', array(
			'pathToQr' => $pathToQr,
			'outputHash' => $outputHash,
			'authmes' => $authmes,
			'username' => $username,
        ));
	
		}
		else{
                $username = '';			
				$htmlcode='';
				$counted='';
				$authmes='Login';
				$ermes='';
				return $this->render('default/login.html.twig', array(
				'ermes' => $ermes,
				'authmes' => $authmes,
				'counted' => $counted,
				));
				
		}
		
		return $username;
    }
}