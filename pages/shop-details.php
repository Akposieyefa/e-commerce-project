<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Shop;

$pdo = new Connection();
$shop = new Shop($pdo);

$product_details = $shop->view([$_GET['product']]);

require_once('../theme/header.php');
?>

<!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="/clothmax/index.php">Home</a>
                            <a href="/clothmax/pages/shop.php">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="/clothmax/assets/<?= $product_details->productPicture; ?>">
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="/clothmax/assets/<?= $product_details->productPicture; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4><?= ucwords($product_details->productName); ?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>

                            <input type="hidden" name="price" value="<?= $product_details->productUnitPrice; ?>">
                            <input type="hidden" name="sku" value="<?= $product_details->SKU ?? 'Null'; ?>">
                            <input type="hidden" name="product_name" value="<?= $product_details->productName ?? 'Null'; ?>">
                            <input type="hidden" name="product_desc" value="<?= $product_details->productDesc ?? 'Null'; ?>">
                            <input type="hidden" name="product_image" value="<?= $product_details->productPicture ?? 'Null'; ?>">

                            <h3>&#163;<?= number_format($product_details->productUnitPrice, 2); ?> </h3>
                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget malesuada. Curabitur aliquet quam id dui posuere blandit. Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <?php $sizes = $shop->get_sizes([$_GET['product']]); ?>
                                    <?php foreach($sizes as $size): ?>
                                        <label><?= $size->sizes; ?>
                                            <input type="radio" name="size" value="<?= $size->sizes; ?>">
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    <?php $colors = $shop->get_colors([$_GET['product']]); ?>
                                    <?php $i=1; foreach($colors as $color): ?>
                                    <label style="background-color: <?= $color->hex; ?>;">
                                        <input type="radio" name="color" value="<?= $color->color; ?>">
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" id="qty">
                                    </div>
                                </div>
                                <?= ($product_details->productAvailable) ? '<a href="#" class="primary-btn add-cart" data-id="'.$product_details->productID.'">add to cart</a>' : '<span class="primary-btn">Out of Stock</span>' ; ?>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="/clothmax/assets/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> <?= ($product_details->SKU != '') ? $product_details->SKU : 'Null' ; ?></li>
                                    <li><span>Categories:</span><span style="text-transform: capitalize; color:#111111; font-weight: 700;"> <?= $shop->get_category([$_GET['product']])->categoryName ?? 'Null'; ?> </span><input type="hidden" name="product_category" value=" <?= $shop->get_category([$_GET['product']])->categoryName ?? 'Null'; ?> <?= $shop->get_subcategory([$_GET['product']])->subCategoryName ?? 'Null'; ?>"></li>
                                    <li><span>Tag:</span><span style="text-transform: capitalize; color:#111111; font-weight: 700;"> <?= $shop->get_category([$_GET['product']])->categoryName ?? 'Null'; ?>, <?= $shop->get_subcategory([$_GET['product']])->subCategoryName ?? 'Null'; ?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p><?= $product_details->productDesc; ?>.</p>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <?= $product_details->productDesc; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <?= $product_details->productDesc; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                <?php $relatedProducts = $shop->related_product([$_GET['product']]); ?>
                        <?php foreach($relatedProducts as $items): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/clothmax/assets/<?= $items->productPicture; ?>">
                            <?= ($items->trend !='') ? '<span class="label">'.$items->trend.'</span>' : ''; ?>
                            <ul class="product__hover">
                                <li><a href="#"><img src="/clothmax/assets/img/icon/heart.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <?= '<h6><a href="/clothmax/pages/shop-details.php?product='.$items->productSlug.'">'.ucwords($items->productName).'</a></h6>'; ?>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <h5>&#163;<?= number_format($items->productUnitPrice, 2); ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- Related Section End -->

<?php
require_once('../theme/footer.php');
?>

<script type="text/javascript">
    $(document).ready(function(){
        var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000
        });

        load_cart();

        function load_cart()
        {
            $.ajax({
                url: "../config/AjaxHandler.php",
                method: "POST",
                dataType: "json",
                success:function(data)
                {
                    $('.cart_count').html(data.total_item);
                    $('.cart_price').html(data.total_price);
                }
            });
        }

        $(".add-cart").click(function(e){
            e.preventDefault();

            var product_id = $(this).attr("data-id");
            var sku = $("input[name='sku']").val();
            var product_name = $("input[name='product_name']").val();
            var product_desc = $("input[name='product_desc']").val();
            var product_category = $("input[name='product_category']").val();
            var product_image = $("input[name='product_image']").val();
            var product_qty = $("#qty").val();
            var product_color = $("input[name='color']:checked").val();
            var product_size = $("input[name='size']:checked").val();
            var product_price = $("input[name='price']").val();
            if (product_id) {
                if(product_color){
                    if(product_size){
                         var postdata = 'product_id='+product_id+'&sku='+sku+'&product_name='+product_name+'&product_desc='+product_desc+'&product_category='+product_category+'&product_image='+product_image+'&product_qty='+product_qty+'&product_color='+product_color+'&product_size='+product_size+'&product_price='+product_price+'&action=add_cart';
                        // The AJAX
                        $.ajax({
                          type: 'POST',
                          url: '../config/AjaxHandler.php',
                          data: postdata,
                           beforeSend: function() {
                              // setting a timeout
                              $('.add-cart').html('Adding to cart...');
                              $('.add-cart').addClass('disabled');
                            },
                            success: function(response) {
                                let data = $.parseJSON(response);
                                if(data.status==1){
                                  Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                  });
                                  //$('span').html('Something went wrong, try again!');
                                }else{
                                  Toast.fire({
                                    icon: 'error',
                                    title: 'Something went wrong, try again.'
                                    });

                                  setTimeout(function() { 
                                    location.reload();
                                  }, 5000);
                                }

                            },
                            error:function(){
                              alert('Whoops! This didn\'t work. Please contact us.')
                            },
                            complete: function() {
                              $('.add-cart').html('Add to cart');
                              $('.add-cart').removeClass('disabled');
                              load_cart();
                            },
                        });

                        return false;
                    }
                }
            }
            
        });

    });
</script>