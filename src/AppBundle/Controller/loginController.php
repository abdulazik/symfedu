<?php

namespace AppBundle\Controller;
use App\Entity\Task;
use AppBundle\Controller\GenController;
use App\Form\TaskType;
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
use AppBundle\Entity\lastGen;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;



class loginController extends Controller
{
    /**
     * @Route("/login")
     */
    public function multiformAction(Request $request)
    {
			$session = new Session();
			$username = $session->get('username');
		if(!isset($username) or empty($username)){
				
				
		if(isset($_POST['username']) and isset($_POST['password'])){
			
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			
			$usersFetch = $this->getDoctrine()
			->getRepository(users::class)
			->findBy(['username' => $username, 'password' => $password]);
			$counted = '';
			
				if(count($usersFetch) > 0){
					$htmlcode = '';
					$session->set('username', $username);
					//$_SESSION['success'] = "You are now logged in ".$username;
					$ermes = '';
					//$path = $this->get('kernel')->getRootDir() . '/../web/ap_dev.php';
					//$success->writeFile($path.'/gen');
					$htmlcode='';
					$counted='';
					$authmes='Hello '.$username;
					$ermes='';
					$dateY = date('Y-m-d');
					$dateH = date('H:i:s');
					$date = $dateY.$dateH;
					$picHash = md5($date);
					$outputHash = 'f047e2105056cbe073029fb0e139c368';
					$pathToQr = '/qr/web/images/'.$outputHash.'.png';
					$get = '?username='.$username;
					$path = $this->get('kernel')->getRootDir() . '/../web/app_dev.php/gen';
				return $this->render('default/qr.html.twig', array(
				'pathToQr' => $pathToQr,
				'outputHash' => $outputHash,
				'authmes' => $authmes,
				'username' => $username,
				));
				}
				else{
					$htmlcode='<form method="post" action="http://localhost/qr/web/app_dev.php/login">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>';
					$counted = count($usersFetch);
					$authmes='';
					$ermes='There is not such user!';
					return $this->render('default/login.html.twig', array(
					'ermes' => $ermes,
					'authmes' => $authmes,
					'counted' => $counted,
					'htmlcode' => $htmlcode,
					));
				}
		}
		else{
			$htmlcode='<form method="post" action="http://localhost/qr/web/app_dev.php/login">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		<a href="register.php">Sign up</a>
  	</p>
  </form>';
				$counted='';
				$authmes='Login';
				$ermes='';
				return $this->render('default/login.html.twig', array(
				'ermes' => $ermes,
				'authmes' => $authmes,
				'counted' => $counted,
				'htmlcode' => $htmlcode,
				));
		}
	}
	
	else{
			$htmlcode='';
			$counted='';
			$authmes='Hello '.$username;
			$ermes='';
			$pathToQr = $session->get('pathToQr');
			$outputHash = $session->get('outputHash');
			$get = '?username='.$username;
			$path = $this->get('kernel')->getRootDir() . '/../web/app_dev.php/gen';
			return $this->render('default/qr.html.twig', array(
					'pathToQr' => $pathToQr,
					'outputHash' => $outputHash,
					'authmes' => $authmes,
					'username' => $username,
					));
		}
	
    }
		
	}
