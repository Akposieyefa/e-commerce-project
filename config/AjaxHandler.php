<?php
require_once("../config/initialize.php");

/* Include neccessary classes for these file */

use app\config\Connection;
use app\config\Session;
use app\classes\Cart;
use app\classes\Customers;

/* Intantiating session class */
$session = new Session();

/* Store $_POST/$_GET/$_REQUEST on $param variable */
$param = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '' ;

if(isset($_POST['product_id'])){

	if(!empty($param)){
		
		if($param == 'add_cart'){
			$product_id = $_POST['product_id'];
			$product_qty = $_POST['product_qty'];
			$product_color = $_POST['product_color'];
			$product_size = $_POST['product_size'];
			$product_price = $_POST['product_price'];

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->add_cart($_POST);
		}
	}
}

/* This lines of code handles all cart ajax calls */

if(!empty($_SESSION["shopping_cart"])){
	
	if (!empty($param)) {

		if ($param == 'cart_details') {

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->cart_detail();

		}elseif($param == 'update_cart'){

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->update_cart($_POST);

		}elseif($param == 'remove'){

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->remove_cart($_POST);

		}elseif($param == 'empty_cart'){

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->empty_cart($_POST);

		}elseif($param == 'checkout'){

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->load_checkout($_POST);

		}elseif($param == 'place_order'){

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$cart->place_order($_POST);

		}elseif($param == 'place_order_acct'){

			$pdo = new Connection();
			$cart = new Cart($pdo);

			$customer = new Customers($pdo);

			if(!$customer->check_email_exist($_POST['email'])){

				if($cust_id = $customer->registration($from_order=1,$_POST)){

					$cart->place_order_acct($cust_id,$_POST);
				}

			}else{
				$data = array(
                    'status'    =>  0,
                    'message'   =>  'Customer with this email already exists'
                );
                echo json_encode($data);
			}

		}elseif($param == 'login'){

			$pdo = new Connection();
			$customer = new Customers($pdo);

			$customer->login($_POST);
		}
	}else{

		$pdo = new Connection();
		$cart = new Cart($pdo);

		echo $cart->fetch_cart();
	}

}

