<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Functions;
use app\classes\Order;


$functions = new Functions();

$pdo = new Connection();
$order = new Order($pdo);

require_once('../theme/header.php');

$orders = $order->get_order_detail($_GET['order_id']);

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