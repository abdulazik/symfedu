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
use AppBundle\Entity\users;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;



class registerController extends Controller
{
    /**
     * @Route("/register")
     */
    public function multiformAction(Request $request)
    {	
		
	if(!isset($_POST['username']) && !isset($_POST['email']) && !isset($_POST['password1']) && !isset($_POST['password2'])){
			$ermes = '';
			
			return $this->render('default/register.html.twig', array(
				'ermes'=> $ermes,
		
			));
	}
	else{
		if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2'])){
		
		if($_POST['password1'] == $_POST['password2']){
				
		
				$ermes = 'Success';
				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = md5($_POST['password1']);
				$date = date('Y-m-d');
				
				$usersFetch = $this->getDoctrine()
				->getRepository(users::class)
				->findBy(['email' => $email]);
				
				$counted = count($usersFetch);
				if(empty($usersFetch)){
				
				$em = $this->getDoctrine()->getManager();

				$users = new users();
				$users->setUsername($username);
				$users->setEmail($email);
				$users->setPassword($password);
				$users->setDate($date);

				// tells Doctrine you want to (eventually) save the Product (no queries yet)
				$em->persist($users);

				// actually executes the queries (i.e. the INSERT query)
				$em->flush();
				}
				else{
					$ermes = 'User with such email already exists';
				}
				
			return $this->render('default/register.html.twig', array(
				'ermes'=> $ermes,
		
			));
		}
		else{
			$ermes = 'Passowords must match!';
			$username = '';
			
			return $this->render('default/register.html.twig', array(
				'ermes'=> $ermes,
		
			));
		}
	  }
	  else{
		  $ermes = 'Fill all inputs';
		  
			return $this->render('default/register.html.twig', array(
				'ermes'=> $ermes,
		
			));
	  }
	}
	
    }
}
