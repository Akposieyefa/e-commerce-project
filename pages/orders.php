<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Order;


$pdo = new Connection();
$order = new Order($pdo);

require_once('../theme/header.php');

$orders = $order->orders();
?>

<!-- Profile Edit Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <?php require_once('../theme/side-nav.php'); ?>
              </div>
            <div class="col-lg-8 col-md-8">
              <div class="card mb-3">
                <div class="card-body" style="overflow-x:auto;">
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
		                    <td><strong><a href="/clothmax/pages/order-details.php?order_id=<?= $order->id; ?>"><?= $order->order_id; ?></a></strong></td>
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
	            		<h3 class="text-center text-muted">Nothing to display</h3>
	            	<?php endif; ?>
              	</div>
              </div>
       		</div>
    	</div>
    </div>
  </div>
</section>
<!-- Profile Edit Section End -->

<?php
require_once('../theme/footer.php');
?>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example1').DataTable();
} );
</script>