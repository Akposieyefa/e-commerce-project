<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Session;
use app\config\Functions;
use app\classes\Customers;

$session = new Session();
$functions = new Functions();

$pdo = new Connection();
$customer = new Customers($pdo);

if($customer->logout()){
	$functions->redirect_to('/clothmax/pages/signin.php');
	echo "string";
}



?>