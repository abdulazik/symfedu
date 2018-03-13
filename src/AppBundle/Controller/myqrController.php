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
			$okfc= '{"sz":33,"st":"oval","nc":1,"nt":1}';
			$url1 = $_SERVER['REQUEST_URI'];
			$url2 = str_replace("/","%2F",$url1);
			$htmlqrtemp = '<div class="inputqr">
				<div class="pic"><img src="/qr/web/images/'.$paths[$n].'.png" width="50px"></div>
				<div class="picname">'.$paths[$n].'</div>
				<div class="date">'.$dates[$n].'</div>
				<div class="date"><script type="text/javascript">document.write(VK.Share.button({url: "http://localhost/qr/web/app_dev.php/", image: "http://localhost/qr/web/images/'.$paths[$n].'.png", title: "Qr-код '.$username.'`a! Попробуй и ты!"}, {type: "custom", text: "<img src=\"https://soskol.com/images/vk.png\" width=\"32\"/>"}));
</script><a href="https://www.facebook.com/share.php?u=http://localhost/qr/web/app_dev.php/myqr">
    <img src="https://cdn.pixabay.com/photo/2017/08/20/10/30/facebook-2661207_960_720.jpg" width="32" alt="share icon">
</a><a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Join%20Us!%20'.$username.'%20recomends!" target="_blank"><img src="https://seeklogo.com/images/T/twitter-2012-negative-logo-5C6C1F1521-seeklogo.com.png" width="32"/></a>
  <a href="https://connect.ok.ru/dk?cmd=WidgetSharePreview&st.cmd=WidgetSharePreview&st.hosterId=47126&st._aid=ExternalShareWidget_SharePreview&st.shareUrl=http%3A%2F%2F'.$url2.'" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0c/Odnoklassniki.svg/1029px-Odnoklassniki.svg.png" width="32"/></a>
  </div></div>';
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
