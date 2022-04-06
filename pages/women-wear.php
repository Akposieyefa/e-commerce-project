<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\config\Pagination;
use app\classes\Women;

$pdo = new Connection();
$women = new Women($pdo);

if(isset($_GET["page"]))

$page = (int)$_GET["page"];

else

$page = 1;
$setLimit = 6;
$pageLimit = ($page * $setLimit) - $setLimit;




require_once('../theme/header.php');
?>


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Women Wears</h4>
                        <div class="breadcrumb__links">
                            <a href="/clothmax/">Home</a>
                            <span>women wears</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseCategories">Categories</a>
                                    </div>
                                    <div id="collapseCategories" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php $categories = $women->categories(); ?>
                                                    <?php foreach($categories as $category): ?>
                                                    <?= '<li><a href="/clothmax/pages/'.$category->categorySlug.'.php">'.ucwords($category->categoryName).'</a></li>' ; ?>
                                                    
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Sub Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <?php $subcategories = $women->subcategories(['women-wear']); ?>
                                                    <?php foreach($subcategories as $subcategory): ?>
                                                    <?= '<li><a href="/clothmax/pages/women-wear.php?category='.$subcategory->subCategorySlug.'">'.ucwords($subcategory->subCategoryName).'</a></li>' ; ?>
                                                    
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    <?php $brands = $women->brands(); ?>
                                                    <?php foreach($brands as $brand): ?>
                                                    <li><a href="#"><?= ucwords($brand->brandName); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="#">&#163;0.00 - &#163;50.00</a></li>
                                                    <li><a href="#">&#163;50.00 - &#163;100.00</a></li>
                                                    <li><a href="#">&#163;100.00 - &#163;150.00</a></li>
                                                    <li><a href="#">&#163;150.00 - &#163;200.00</a></li>
                                                    <li><a href="#">&#163;200.00 - &#163;250.00</a></li>
                                                    <li><a href="#">250.00+</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                    </div>
                                    <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__tags">
                                                <a href="#">Product</a>
                                                <a href="#">Bags</a>
                                                <a href="#">Shoes</a>
                                                <a href="#">Fashio</a>
                                                <a href="#">Clothing</a>
                                                <a href="#">Hats</a>
                                                <a href="#">Accessories</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                        <?php if(isset($_GET['category'])): ?>
                        <?php  $slug = $_GET['category']; ?>    
                            <p><?= $women->product_results($slug,$setLimit,$page); ?></p>
                        <?php else: ?>
                             <?php  $slug = ''; ?>  
                            <p><?= $women->product_results($slug,$setLimit,$page); ?></p>
                        <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select>
                                        <option value="">Low To High</option>
                                        <option value="">$0 - $55</option>
                                        <option value="">$55 - $100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(isset($_GET['category'])): ?>
                        <?php  $slug = $_GET['category']; 
                            if ($products = $women->get_category_products($slug,[$pageLimit, $setLimit])): ?>
                        <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="/clothmax/assets/<?= $product->productPicture; ?>">
                                        <?= (isset($product->trend)) ? '<span class="label">'.ucwords($product->trend).'</span>' : ''; ?>
                                        <ul class="product__hover">
                                            <li><a href="#" id="fav"><img src="/clothmax/assets/img/icon/heart.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                <div class="product__item__text">
                                    <?= '<h6><a href="/clothmax/pages/shop-details.php?product='.$product->productSlug.'">'.ucwords($product->productName).'</a></h6>'; ?>
                                    <!-- <?//= ($product->productAvailable) ? '<a href="" class="add-cart" id="'.$product->productID.'">+ Add To Cart</a>' : '<a class="add-cart">Out of Stock</a>'; ?> -->
                                    
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>&#163;<?= number_format($product->productUnitPrice, 2); ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php else: ?>


                        <?php $products = $women->index([$pageLimit, $setLimit]); ?>
                        <?php foreach ($products as $product): ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="/clothmax/assets/<?= $product->productPicture; ?>">
                                        <?= (isset($product->trend)) ? '<span class="label">'.ucwords($product->trend).'</span>' : ''; ?>
                                        <ul class="product__hover">
                                            <li><a href="#" id="fav"><img src="/clothmax/assets/img/icon/heart.png" alt=""></a></li>
                                        </ul>
                                    </div>
                                <div class="product__item__text">
                                    <?= '<h6><a href="/clothmax/pages/shop-details.php?product='.$product->productSlug.'">'.ucwords($product->productName).'</a></h6>'; ?>
                                    <!-- <?//= ($product->productAvailable) ? '<a href="" class="add-cart" id="'.$product->productID.'">+ Add To Cart</a>' : '<a class="add-cart">Out of Stock</a>'; ?> -->
                                    
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>&#163;<?= number_format($product->productUnitPrice, 2); ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($_GET['category'])): ?>
                        <?php   $slug = $_GET['category']; ?>
                            <?= $women->displayPaginationBelow($slug,$setLimit,$page); ?>
                        <?php else: ?>
                             <?php  $slug = ''; ?>  
                            <?= $women->displayPaginationBelow($slug,$setLimit,$page); ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

<?php
require_once('../theme/footer.php');
?>

<script type="text/javascript">
    $(document).ready(function(){

        $(".add-cart").click(function(e){
            e.preventDefault();

            var product_id = $(this).attr("id");
            if (product_id) {
                console.log(product_id);
            }
            
        });

    });
</script>