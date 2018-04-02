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



class ajaxController extends Controller
{
    /**
     * @Route("/ajax")
     */
    public function multiformAction(Request $request)
    {
		if($request->request->get('some_var_name')){
        //make something curious, get some unbelieveable data
        $arrData = ['output' => 'here the result which will appear in div'];
        return new JsonResponse($arrData);
    }

		return $this->render('default/ajax.html.twig');
    }
}
