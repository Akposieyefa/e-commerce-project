<?php
require_once('../config/initialize.php');

use app\config\Connection;
use app\config\Functions;
use app\classes\Admin;


$pdo = new Connection();
$admin = new Admin($pdo);

$functions = new Functions();

$error = '';

if (isset($_POST['submit'])) {
  if($admin->admin_change_password($_POST)){
    echo "<script>alert('Password Updated')</script>";

    $functions->redirect('logout.php');
  }
  else{
    $error .= 'Password mis-matched';
  }
}

  require_once('theme/admin_header.php');
  require_once('theme/main_header.php');
  require_once('theme/main_sidebar.php');

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= ucwords($pg); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Product</li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>
              <?php if($error): ?>
              <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-dismiss="alert"></button>
                <strong><?= $error; ?> </strong>
              </div>
              <?php endif; ?>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <form method="POST"> 
                <input type="hidden" name="admin_user_id" value="<?= $_SESSION['admin_user_id']; ?>">
                <div class="form-group">
                  <label>New Password</label>
                  <input type="password" class="form-control" name="newPassword" required>
                </div>
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control" name="confirmPassword" required>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success float-left" name="submit">Change Password</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php

  require_once('theme/admin_footer.php');

?>