<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Admin;
use app\config\Functions;

$pdo = new Connection();
$admin = new Admin($pdo);
$functions = new Functions();

$error = '';

if(isset($_POST['login'])){
  if($admin->check_email_exist($_POST['admin_email'])){

    if($admin->login($_POST)){
      ?>
      <script type="text/javascript">
        alert('Login successful');
      </script>
      <?php

      $functions->redirect('/clothmax/admin/dashboard.php');
    }else{

      $error .= 'Invalid login details';
    }
  }
  else{
    
    $error .= 'Invalid login details';
  }
}

if(isset($_SESSION['loggedin'])){
    $functions->redirect('/clothmax/admin/dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/clothmax/assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/clothmax/assets/backend/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/clothmax/"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      
      <!-- Flash messages -->
      <?php if($error): ?>
      <div class="alert alert-dismissible alert-danger">
          <button type="button" class="btn-close" data-dismiss="alert"></button>
          <strong><?= $error; ?></strong>
      </div>
      <?php endif; ?>

      <form method="POST">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="admin_email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block text-center" name="login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/clothmax/assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/clothmax/assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/clothmax/assets/backend/dist/js/adminlte.min.js"></script>

</body>
</html>
