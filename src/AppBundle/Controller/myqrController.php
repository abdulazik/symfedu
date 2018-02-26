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
use AppBundle\Entity\users;
use AppBundle\Entity\Qrcode1;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;



class myqrController extends Controller
{
    /**
     * @Route("/myqr")
     */
    public function myqr(Request $request)
    {
		$session = new Session();
		$username = $session->get('username');
		if(!isset($username)){
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
		else{
			$em = $this->getDoctrine()->getManager();
			$queryName = $em->createQuery(
				'SELECT q.name 
				FROM AppBundle:Qrcode1 q
				WHERE q.username = :username'
			)->setParameter('username', $username);
			
			$productsName = $queryName->getResult();
			//print_r($productsName[1]);
			$n = count($productsName)-1;
			$paths = array();
			while($n != -1){
				$b = implode("",$productsName[$n]);
				$onlyName = str_replace("name","",$b);
				$picpath= $onlyName;
				array_push($paths, $picpath);
				$n--;
			}
			
			$em2 = $this->getDoctrine()->getManager();
			$queryDate = $em2->createQuery(
				'SELECT q.date 
				FROM AppBundle:Qrcode1 q
				WHERE q.username = :username'
			)->setParameter('username', $username);
			
			$productsDate = $queryDate->getResult();
			$n = count($productsDate)-1;
			$dates = array();
			while($n != -1){
				$с = implode("",$productsDate[$n]);
				$onlyDate = str_replace("date","",$с);
				$picdate= '<div class="picdate">'.$onlyDate.'</div>';
				array_push($dates, $picdate);
				$n--;
			}
			$n = count($productsDate)-1;
			$htmlqr = array();
			while($n != -1){
			$htmlqrtemp = '<div class="inputqr">
				<div class="pic"><img src="/qr/web/images/'.$paths[$n].'.png" width="50px"></div>
				<div class="picname">'.$paths[$n].'</div>
				<div class="date">'.$dates[$n].'</div>
			</div>';
			array_push($htmlqr, $htmlqrtemp);
			$n--;
			}
			//print_r($paths);
			//print_r($paths);
			//$n = count($qrsFetch)-1;
			//$paths = array();
			//while($n != -1){
			//	array_push($paths, $qrsFetch[$n]);
			//	$n--;
			//}
			//print_r($paths);
			if(count($htmlqr) > 0){
				return $this->render('default/myqr.html.twig', array(
				'htmlqr' => $htmlqr,
				));
			}
		}
		
    }
}
