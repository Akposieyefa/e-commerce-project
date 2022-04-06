<?php 
namespace app\classes;


/**
 * class Admin
 */

use app\config\Session;

class Admin extends Admin_m
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
		
		$session = new Session();
	}

	public function login($value='')
	{
		return $this->admin_login($value);
	}

	// display info box on dashboard.
	public function order_box($value='')
	{
		return $this->order_count($value);
	}

	// display info box on dashboard.
	public function product_box($value='')
	{
		return $this->product_count($value);
	}

	// display info box on dashboard.
	public function customer_box($value='')
	{
		return $this->customer_count($value);
	}

	public function profile($value='')
	{
		return $this->admin_profile($value);
	}

	public function admin_change_password($value='')
	{
		return $this->change_password($value);
	}

	public function logout($value='')
	{
		return $this->logouts($value);
	}

	// check if user exists before loggin.
	public function check_email_exist($email='')
	{
		if($this->check_email_exists($email)){
			return true;
		}else{
			return false;
		}
	}
}