<?php
require_once('../config/initialize.php');

use app\config\Connection;
use app\classes\Shop;


$pdo = new Connection();
$shop = new Shop($pdo);

$shops = $shop->view($args=FALSE);

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
              	
            <?php if($shops): ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Product Image</th>
                    <th>Product</th>
                    <th>Sizes</th>
                    <th>Colors</th>
                    <th>Description</th>
                    <th>Created On</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $i=1; foreach($shops as $res): ?>
	                  <tr>
	                    <td><?= $i++; ?></td>
	                    <td><img src="/clothmax/assets/<?= $res->productPicture; ?>" alt="product image" width="70" class="img-fluid rounded shadow-md"></td>
	                    <td>
                        <div class="pos-relative">
                          <h6 class="text-primary text-sm">
                            <a href="#" class="text-primary"><?= ucwords($res->productName); ?></a>
                          </h6>
                           <p class="mb-0 text-sm"><strong>SKU:</strong><?= $res->SKU; ?>  &nbsp;&nbsp;<strong>price:</strong> <?= number_format($res->productUnitPrice, 2); ?></p>
                           <p class="mb-0 text-sm"><strong><?= ($res->productAvailable) ? '<span class="text-success">In Stock</span>' : '<span class="text-danger">Out of Stock</span>'; ?></strong>&nbsp;&nbsp;<strong>Trend:</strong> <?= '<span class="text-default">'.ucwords($res->trend).'</span>' ; ?></p>

                           <?php

                          $categories = $shop->get_category([$res->productSlug]);
                          $subcategories = $shop->get_subcategory([$res->productSlug]);
?>
                            <p class="mb-0 text-sm"><strong>Category:</strong> <?= $categories->categoryName ?? 'Null'; ?>  &nbsp;&nbsp;<strong>Sub Category:</strong> <?= $subcategories->subCategoryName ?? 'Null'; ?></p>
                        </div>
                      </td>

	                    <td>
                       <?php $sizes = $shop->get_sizes([$res->productSlug]); ?>
                        <?php foreach($sizes as $size): ?>
                           <p class="mb-0 text-sm"><?= $size->sizes; ?></p>
                        <?php endforeach; ?> 
                      </td>

	                    <td>
                        <?php $colors = $shop->get_colors([$res->productSlug]); ?>
                        <?php $i=1; foreach($colors as $color): ?>
                        <span style="background-color: <?= $color->hex; ?>;" title="<?= $color->color; ?>"><?= $color->color; ?></span> | 
                        <?php endforeach; ?>
                      </td>
	                    <td><?= $res->productDesc; ?></td>
	                    <td><?= $res->productDateAdded; ?></td>
	                  </tr>
             	  <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S/N</th>
                    <th>Product Image</th>
                    <th>Product</th>
                    <th>Sizes</th>
                    <th>Colors</th>
                    <th>Price</th>
                    <th>Created On</th>
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
