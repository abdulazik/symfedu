<?php
namespace AppBundle\Controller;
use App\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Symfony\Component\HttpFoundation\Session\Session;
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
    public function gen(Request $request)
    {
		
		$session = new Session();
		$username = $session->get('username');
		if(isset($_POST['logout'])){
			unset($username);
			unset($pathToQr);
			unset($outputHash);
		}
		if(isset($username) or !empty($username)){
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
				$qrcode1->setUsername($username);
				// tells Doctrine you want to (eventually) save the Product (no queries yet)
				$em->persist($qrcode1);

				// actually executes the queries (i.e. the INSERT query)
				$em->flush();
			}
			else{
				
			}
		
	}
	
	$pathToQr = '/qr/web/images/'.$outputHash.'.png';
	$session->set('pathToQr', $pathToQr);
	$session->set('outputHash', $outputHash);
	$authmes = 'Hello '.$username;
        
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
    }
}
