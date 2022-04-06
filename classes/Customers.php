<?php
namespace app\classes;

/**
 * 
 */

class Customers extends Customers_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function registration($from_order=1,$value='')
	{
		return $this->registrations($from_order,$value);
	}

	public function login($value='')
	{
		return $this->logins($value);
	}

	public function list($value='')
	{
		return $this->users_profile();
	}
	public function user_profile($value='')
	{
		return $this->users_profile($value);
	}

	public function user_edit_profile($value='')
	{
		return $this->users_edit_profile($value);
	}

	public function change_password($value='')
	{
		return $this->change_passwords($value);
	}

	public function check_email_exist($email='')
	{
		if($this->check_email_exists($email)){
			return true;
		}else{
			return false;
		}
	}

	public function logout($value='')
	{
		return $this->logouts($value);
	}


}