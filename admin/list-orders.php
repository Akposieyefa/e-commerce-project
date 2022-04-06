<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Session;
use app\classes\Order;


$pdo = new Connection();
$order = new Order($pdo);
$session = new Session($pdo);

$orders = $order->orders();

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
              <li class="breadcrumb-item">Orders</li>
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
              	
            <?php if($orders): ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
	                    <th>Order ID</th>
	                    <th>Order Date</th>
	                    <th>Payment Type</th>
	                    <th>Order Cost</th>
	                    <th>Status</th>
	                    <th>Delivery Info</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; foreach($orders as $order): ?>
	                  	<tr>
		                    <td><?= $i++; ?></td>
		                    <td><strong><a href="/clothmax/admin/order-details.php?order_id=<?= $order->id; ?>"><?= $order->order_id; ?></a></strong></td>
		                    <td><?= $order->order_date; ?></td>

		                    <td><?= $order->paymentType; ?></td>

		                    <td><?= $order->totalAmount; ?></td>
		                    <td><?= $order->status; ?></td>
		                    <td>
		                    	<div class="pos-relative">
					                <h6 class="text-primary text-sm">
					                  <a href="#" class="text-primary"><?= $order->orderContactName; ?></a>
					                </h6>
					                <p class="mb-0 text-sm"><span class="op-6"><?= $order->orderPhone; ?></span> <span class="text-black" href="#"><?= ($order->orderExphone) ?? ''; ?></span> <span class="op-6"><?= $order->orderaddInfo ?? ''; ?></span></p>
					                 <p class="mb-0 text-sm"><span class="op-6"><?= $order->orderAddress; ?></span> <span class="text-black" href="#"><?= ($order->orderCity) ?? ''; ?></span> <span class="op-6"><?= $order->orderState; ?></span> <a class="text-black" href="#"><?= $order->orderCountry; ?></a></p>
					            </div>
		                    </td>
		                </tr>
             	  <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S/N</th>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Payment Type</th>
                    <th>Order Cost</th>
                    <th>Status</th>
                    <th>Delivery Info</th>
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
<script type="text/javascript">
	$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>