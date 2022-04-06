<?php
namespace app\classes;


use app\config\Functions;

/**
 * 
 */

class Order_m
{
	
	public function get_orders($value='')
	{
		$functions = new functions();

		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/pages/signin.php');
			exit();
		}

		if(isset($_SESSION['cust_user_id'])){

			$orders = $this->pdo->preparedStatement("SELECT p.paymentType, o.* FROM orders o INNER JOIN paymenttype p ON p.id=o.payment_id WHERE o.c_id='{$_SESSION["cust_user_id"]}' ORDER BY id DESC");

			return $orders->fetchAll();

		}elseif (isset($_SESSION['admin_user_id'])) {

			$orders = $this->pdo->preparedStatement("SELECT p.paymentType, o.* FROM orders o INNER JOIN paymenttype p ON p.id=o.payment_id ORDER BY id DESC");

			return $orders->fetchAll();
		}

		
	}

	public function get_order_details($value='')
	{
		$functions = new functions();
		
		if(!isset($_SESSION['loggedin'])){
			$functions->redirect('/clothmax/pages/signin.php');
			exit();
		}

		$result = $this->pdo->preparedStatement("SELECT p.productName, p.SKU, p.productPicture, o.* FROM orderdetail o INNER JOIN products p ON p.productID=o.productID WHERE o.orderID='$value'");

		return $result->fetchAll();
	}
}