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
    public function gen(Request $request, \Swift_Mailer $mailer)
    {
		
		$session = new Session();
		$username = $session->get('username');
		if(isset($_POST['logout'])){
			$session->invalidate();
		}
		if(isset($username) or !empty($username)){
			$email = $this->getDoctrine()->getManager();
				$queryMail = $email->createQuery(
					'SELECT q.email
					FROM AppBundle:users q
					WHERE q.username = :username'
				)->setParameter('username', $username);
				$productsMail = $queryMail->getResult();
				$сmail = implode("",$productsMail[0]);
				$mail = str_replace("email","",$сmail);
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

			// Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
			$stamp = imagecreatefrompng('http://localhost/qr/web/images/stamp.png');
			$im = imagecreatefrompng('http://localhost/qr/web/images/'.$outputHash.'.png');

			// Установка полей для штампа и получение высоты/ширины штампа
			$marge_right = 0;
			$marge_bottom = 0;
			$sx = imagesx($stamp);
			$sy = imagesy($stamp);
			imagealphablending($stamp, true);
			imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
			// Вывод и освобождение памяти
			imagepng($im, "C:\op\OpenServer\domains\localhost\qr/web/images/".$outputHash.".png");
			imagedestroy($im);
			
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
				//email sendment
				$mailmessage = (new \Swift_Message('Hello Email'))
					->setFrom('shaks.fon@yandex.ru')
					->setTo($mail)
					->setBody(
					$this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Email/qrsend.html.twig',
                array('username' => $username, 'picHash' => $picHash)
            ),
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'Emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
    ;

    $mailer->send($mailmessage);
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
			'mail' => $mail,
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
