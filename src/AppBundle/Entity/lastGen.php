<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class lastGen{

	
	public $lastArray;
	
	public function lastPost($integers=array(0, 1 , 2, 3, 4), $num=0){
		$num=count($integers);
		return $num;
	}
	
}

