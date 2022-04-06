<?php
require_once('../config/initialize.php');

use app\config\Connection;
use app\config\Session;
use app\classes\Category;
use app\classes\Subcategory;
use app\classes\Color;
use app\classes\Size;
use app\classes\Shop;


$pdo = new Connection();
$session = new Session();
$category = new Category($pdo);
$subcategory = new Subcategory($pdo);
$color = new Color($pdo);
$size = new Size($pdo);
$shop = new Shop($pdo);

$categories = $category->list();
$subcategories = $subcategory->list();
$colors = $color->list();
$sizes = $size->list();



$error = '';
$success = '';

if(isset($_POST['submit'])){
  if($shop->check_product_exists($_POST['product_name'])){

    $error .= 'Product name exists';

  }else{

      if($shop->create($_POST)){

        $success .= 'Product Added';

      }
      else{
        
        $error .= 'Invalid login details';
      }
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

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <?php if($success): ?>
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="btn-close" data-dismiss="alert"></button>
              <strong><?= $success; ?> </strong>
            </div>
            <?php endif; ?>
            <?php if($error): ?>
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="btn-close" data-dismiss="alert"></button>
              <strong><?= $error; ?> </strong>
            </div>
            <?php endif; ?>
              <form method="POST"> 
                <input type="hidden" name="admin_user_id" value="<?= $_SESSION['admin_user_id']; ?>">
                <div class="form-group">
                  <label for="inputName">Product Name</label>
                  <input type="text" id="inputName" class="form-control" name="product_name" required>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control select2" style="width: 100%;" name="category_id" required>
                        <option></option>
                        <?php foreach($categories as $category): ?>
                          <option value="<?= $category->categoryID; ?>"><?= ucwords($category->categoryName); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sub category</label>
                      <select class="form-control select2" style="width: 100%;" name="sub_category_id">
                        <option value=""></option>
                        <?php foreach($subcategories as $subcategory): ?>
                          <option value="<?= $subcategory->subCategoryID; ?>"><?= ucwords($subcategory->subCategoryName); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="inputSKU">SKU</label>
                      <input type="text" id="inputSKU" class="form-control" name="product_sku">
                    </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="inputPrice">Price</label>
                        <input type="text" id="inputPrice" class="form-control" name="product_price" required>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="summernote">Description</label>
                  <textarea id="summernote" class="form-control" name="product_desc" required></textarea>
                </div>
                <div class="form-group">
                  <label for="inputPicture">Picture</label>
                  <input type="text" id="inputPicture" class="form-control" name="product_picture" required>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title">Color(s)</h3>
                      </div>
                      <div class="card-body">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <?php $i=1; foreach($colors as $color): ?>
                              <input type="checkbox" id="checkboxPrimary1" name="colors[]" value="<?= $color->colorId; ?>">
                              <label for="checkboxPrimary1">
                                <?= $color->name; ?>
                              </label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php endforeach; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title">Size(s)</h3>
                      </div>
                      <div class="card-body">
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <?php  $i=1; foreach($sizes as $size): ?>
                            <input type="checkbox" id="checkboxPrimary1" name="sizes[]" value="<?= $size->sizeId; ?>" checked>
                            <label for="checkboxPrimary1">
                              <?= $size->name; ?>
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php endforeach; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Trend</label>
                  <select class="form-control select2" style="width: 100%;" name="trend">
                    <option value=""></option>
                    <option value="best">Best</option>
                    <option value="new">New</option>
                    <option value="hot">Hot</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success float-left" name="submit">Create new Product</button>
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