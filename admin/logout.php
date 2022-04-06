<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Session;
use app\config\Functions;
use app\classes\Admin;

$session = new Session();
$functions = new Functions();

$pdo = new Connection();
$admin = new Admin($pdo);

if($admin->logout()){
	$functions->redirect_to('/clothmax/admin/');
}



?>