<?php
namespace app\classes;


use app\config\Functions;

class Customers_m
{
	public function registrations($from_order=1,$value='')
	{
		$functions = new Functions();

		if ($value['password'] != '') {

			/*$this->pdo->preparedStatement("INSERT INTO `customers` (`customer_ip`, `customer_firstName`, `customer_lastName`, `customer_email`, `customer_pass`, `customer_country`, `customer_state`, `customer_city`, `customer_contact`, `customer_address`) VALUES (?,?,?,?,?,?,?,?,?,?)", $value);*/

			$ip = $functions->getIp();
			$address = $value['address'] ?? 'null';
			$orderCity = $value['city'] ?? 'null';
            $orderState = $value['state'] ?? 'null';
            $orderCountry = $value['country'] ?? 'null';
            $orderPhone = $value['phone'] ?? 'null';

			if($this->pdo->preparedStatement("INSERT INTO `customers` (`customer_ip`, `customer_firstName`, `customer_lastName`, `customer_email`, `customer_pass`, `customer_country`, `customer_state`, `customer_city`, `customer_contact`, `customer_address`) VALUES ('$ip', '{$value["firstName"]}', '{$value["lastName"]}', '{$value["email"]}', '{$value["password"]}', '$orderCountry', '$orderState', '$orderCity', '$orderPhone', '$address')")){

				if($from_order == 1){
					$_SESSION['cust_user_id'] = $this->pdo->lastInsertId();
					$_SESSION['email'] = $value["email"];
					$_SESSION['loggedin'] = true;
				}

                return $lastCustomerInsertId = $this->pdo->lastInsertId();
           }
		}
		else{
			$functions->json('0', 'Fill required fields');
		}
		
	}

	public function logins($value='')
	{
		$functions = new Functions();

		if(isset($_SESSION['loggedin'])){
            $functions->json('2', 'You are loggedin');
        }

        if($value != ''){

        	$stmt = $this->pdo->preparedStatement("SELECT * FROM `customers` WHERE `customer_email`='{$value["loginEmail"]}' AND `customer_pass`='{$value["loginPassword"]}'")->fetch();

        	if($stmt){
        		if($value["token"] == 'loginmain'){
	        		$_SESSION['cust_user_id'] = $stmt->customer_id;
					$_SESSION['email'] = $stmt->customer_email;
					$_SESSION['loggedin'] = true;

		        	return true;
        		}else{
        			$_SESSION['cust_user_id'] = $stmt->customer_id;
					$_SESSION['email'] = $stmt->customer_email;
					$_SESSION['loggedin'] = true;
					$functions->json('1', 'Success');
        		}
        		
	        }
	       
        	else{
        		$functions->json('0', 'Account does not exist, please create new account to countinue checkout');
        	}
        	
        }  
	}

	public function users_profile($value='')
	{
		$functions = new functions();

		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/pages/signin.php');
			exit();
		}

		if ($value != ''){

			$customer_profile = $this->pdo->preparedStatement("SELECT * FROM customers WHERE customer_id='$value'");

			if($customer_profile){

				return $customer_profile->fetch();
			}
		}else{

			$customer_profile = $this->pdo->preparedStatement("SELECT * FROM customers");

			if($customer_profile){

				return $customer_profile->fetchAll();
			}
		}
		
	}

	public function users_edit_profile($value='')
	{
		$functions = new functions();

		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/pages/signin.php');
			exit();
		}

		$nameArr = explode(' ', $value['name']);

		$this->pdo->preparedStatement("UPDATE customers SET customer_firstName='{$nameArr[0]}', customer_lastName='{$nameArr[1]}', customer_email='{$value["email"]}', customer_contact='{$value["phone"]}', customer_gender='{$value["gender"]}', customer_address='{$value["address"]}', customer_city='{$value["city"]}', customer_state='{$value["state"]}', customer_country='{$value["country"]}' WHERE customer_id='{$value["customer_id"]}'");

		return true;
	}

	public function change_passwords($value='')
	{
		$functions = new functions();
		
		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/pages/signin.php');
			exit();
		}

		$this->pdo->preparedStatement("UPDATE customers SET customer_pass='{$value["confirmPassword"]}' WHERE customer_id='{$value["customer_id"]}'");

		return true;

	}

	public function logouts($value='')
	{
		unset($_SESSION['cust_user_id']);
		unset($_SESSION['email']);
		unset($_SESSION['loggedin']);

		return true;
	}

	public function check_email_exists($email)
    {
        $stmt = $this->pdo->numberOfRows("SELECT count(*) FROM customers WHERE customer_email='$email'");

        if($stmt > 0){
            return true;
        }else{
            return false;
        }
    }
}