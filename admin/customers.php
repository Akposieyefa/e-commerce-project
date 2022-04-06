<?php
require_once('../config/initialize.php');

use app\config\Connection;
use app\classes\Customers;
use app\config\Session;


$pdo = new Connection();
$customers = new Customers($pdo);
$session = new Session($pdo);

$customer = $customers->list($args=FALSE);

require_once('theme/admin_header.php');
require_once('theme/main_header.php');
require_once('theme/main_sidebar.php');

?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= ucwords($pg); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Product</li>
              <li class="breadcrumb-item active">List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- /.content-header -->

 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- col -->
          <div class="col-12">
            
      		<div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              	
            <?php if($customer): ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Date Joined</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; foreach($customer as $res): ?>
	                  <tr>
	                    <td><?= $i++; ?></td>
	                    <td><?= ucwords($res->customer_firstName).' '.ucwords($res->customer_lastName); ?></td>
	                    <td>
                        <div class="pos-relative">
                          <h6 class="text-primary text-sm">
                            <a href="#" class="text-primary"><?= $res->customer_email; ?></a>
                          </h6>
                           <p class="mb-0 text-sm"><?= $res->customer_contact; ?>  &nbsp;&nbsp; <?= $res->customer_ip; ?></p>
                           <p class="mb-0 text-sm"><?= $res->customer_gender;  ?>&nbsp;&nbsp;</p>
                            <p class="mb-0 text-sm"><?= $res->customer_address; ?>  &nbsp;&nbsp;<?= $res->customer_city; ?></p>
                            <p class="mb-0 text-sm"><?= $res->customer_state; ?>  &nbsp;&nbsp;<?= $res->customer_country; ?></p>
                        </div>
                      </td>
                      <td><?= $res->date_joined; ?></td>
	                  </tr>
             	  <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Date Joined</th>
                  </tr>
                  </tfoot>
                </table>
                <?php else: ?>
                	<h4 class="text-center">Nothing to Display</h4>
                <?php endif; ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php

  require_once('theme/admin_footer.php');

?>
