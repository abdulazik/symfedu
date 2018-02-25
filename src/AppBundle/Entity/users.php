<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class users
{
	/**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	public $id;
	
	/**
     * @ORM\Column(name="date", type="text", length=8)
     */
    public $date;
	/**
     * @ORM\Column(name="username", type="text", length=20)
     */
    public $username;
	
	/**
     * @ORM\Column(name="email", type="text", length=20)
     */
    public $email;
	/**
     * @ORM\Column(name="password", type="text", length=20)
     */
    public $password;
	 
	 /**
     * Set date
	 *
	 *@param string $date
	 *
	 *@return users
     */
	 
	public $lastArray;
	
public function setDate($date){
	$this->date = $date;
	return $this;
}
/**
     * Set username
	 *
	 *@param string $username
	 *
	 *@return users
     */
public function setUsername($username){
	$this->username = $username;
	return $this;
}
/**
     * Set email
	 *
	 *@param string $email
	 *
	 *@return users
     */
public function setEmail($email){
	$this->email = $email;
	return $this;
}
/**
     * Set password
	 *
	 *@param string $password
	 *
	 *@return users
     */
public function setPassword($password){
	$this->password = $password;
	return $this;
}
}

?>