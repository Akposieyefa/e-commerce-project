<?php 
namespace app\classes;

/**
 * 
 */
use app\config\Functions;

class Admin_m
{
	
	public function admin_login($value='')
	{

		if(isset($_SESSION['loggedin'])){
            $functions->redirect('/clothmax/admin/dashboard.php');
        }

        if($value != ''){

        	$pass = md5($value["admin_password"]);

        	$stmt = $this->pdo->preparedStatement("SELECT * FROM `admins` WHERE `user_email`='{$value["admin_email"]}' AND `user_pass`='$pass'")->fetch();

        	if($stmt){
        		
        		$_SESSION['admin_user_id'] = $stmt->user_id;
				$_SESSION['email'] = $stmt->user_email;
				$_SESSION['loggedin'] = true;

	        	return true;        		
	        }
	       
        	else{
        		return false;
        	}
        	
        }  
	}

	public function order_count($value='')
	{
		return $this->pdo->rowCount("SELECT * FROM orders");
	}

	public function product_count($value='')
	{
		return $this->pdo->rowCount("SELECT * FROM products");
	}

	public function customer_count($value='')
	{
		return $this->pdo->rowCount("SELECT * FROM customers");
	}

	public function admin_profile($value='')
	{
		$functions = new functions();

		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/admin/');
			exit();
		}

		if($value === FALSE){
			$customer_profile = $this->pdo->preparedStatement("SELECT * FROM admins");
			if($customer_profile){
				return $customer_profile->fetchAll();
			}
		}else{
			$customer_profile = $this->pdo->preparedStatement("SELECT * FROM admins WHERE user_id='$value'");
			if($customer_profile){
				return $customer_profile->fetch();
			}
		}

		
	}

	public function change_password($value='')
	{
		$functions = new functions();
		
		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/admin/');
			exit();
		}

		if ($value['newPassword'] == $value['confirmPassword']) {
			$pass = md5($value["confirmPassword"]);

			$this->pdo->preparedStatement("UPDATE admins SET user_pass='$pass' WHERE user_id='{$value["admin_user_id"]}'");

			return true;

		}else{
			
			return false;
		}

	}

	public function logouts($value='')
	{
		unset($_SESSION['admin_user_id']);
		unset($_SESSION['email']);
		unset($_SESSION['loggedin']);

		return true;
	}

	public function check_email_exists($email)
    {
        $stmt = $this->pdo->numberOfRows("SELECT count(*) FROM admins WHERE user_email='$email'");

        if($stmt > 0){
            return true;
        }else{
            return false;
        }
    }

}