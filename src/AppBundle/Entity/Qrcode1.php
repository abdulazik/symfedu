<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="qrcodes")
 */
class Qrcode1
{
	/**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	public $id;
	
	/**
     * @ORM\Column(name="date", type="text", length=255)
     */
    public $date;
	/**
     * @ORM\Column(name="time", type="text", length=255)
     */
    public $time;
	
	/**
     * @ORM\Column(name="name", type="text", length=255)
     */
    public $name;
	/**
     * @ORM\Column(name="username", type="text", length=20)
     */
    public $username;
	 
	 /**
     * Set date
	 *
	 *@param string $date
	 *
	 *@return qrcodes
     */
	 
	public $lastArray;
public function setDate($date){
	$this->date = $date;
	return $this;
}
/**
     * Set time
	 *
	 *@param string $time
	 *
	 *@return qrcodes
     */
public function setTime($time){
	$this->time = $time;
	return $this;
}
/**
     * Set name
	 *
	 *@param string $name
	 *
	 *@return qrcodes
     */
public function setName($name){
	$this->name = $name;
	return $this;
}
public function setUsername($username){
	$this->username = $username;
	return $this;
}
}

?>