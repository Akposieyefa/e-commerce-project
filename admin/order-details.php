<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Session;
use app\classes\Order;


$pdo = new Connection();
$order = new Order($pdo);
$session = new Session($pdo);

$orders = $order->get_order_detail($_GET['order_id']);

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
              <li class="breadcrumb-item active">Details</li>
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
              <div class="card-body" style="overflow-x:auto;">
                	<?php if($orders): ?>
              		<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col"></th>
					      <th scope="col">Product Info</th>
					      <th scope="col">Order Quantity</th>
					      <th scope="col">Order Amount</th>
					      <th scope="col">Discount</th>
					      <th scope="col">Status</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php $i=1; foreach($orders as $order): ?>
					    <tr>
					      <th scope="row"><?= $i++; ?></th>
					      <td>
					      	<div class="product__cart__item__pic">
                              <img src="/clothmax/assets/<?= $order->productPicture; ?>" alt="product image" width="70" class="img-fluid rounded shadow-sm">
                            </div>
                        	</td>
					      <td>
					      	<div class="pos-relative">
				                <h6 class="text-primary text-sm">
				                  <a href="#" class="text-primary"><?= ucwords($order->productName); ?></a>
				                </h6>
				                 <p class="mb-0 text-sm"><strong>Track Id:</strong><?= $order->track_id; ?>  &nbsp;&nbsp;<strong>SKU:</strong> <?= $order->SKU; ?></p>
                                <p class="mb-0 text-sm"><strong>color:</strong> <?= $order->color; ?>  &nbsp;&nbsp;<strong>size:</strong> <?= $order->size; ?></p>
				            </div>
					      </td>
					      <td><?= $order->qty; ?></td>
					      <td>&#163;<?= $order->total; ?></td>
					      <td><?= ($order->discount) ?? ''; ?></td>
					      <td><?= $order->status; ?></td>
					    </tr>
					    <?php endforeach; ?>
					  </tbody>
					</table>
					<?php else: ?>
	            		<h3 class="text-center text-muted">Nothing to display</h3>
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