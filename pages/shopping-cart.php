<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Shop;

$pdo = new Connection();

/*session_start();
session_destroy();*/

require_once('../theme/header.php');
?>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="/clothmax/">Home</a>
                        <a href="/clothmax/pages/shop.php">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="cart_details">
                            
                            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="/clothmax/pages/shop.php">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#" class="empty_cart"><i class="fa fa-trash"></i> Empty cart</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span class="cart_price">&#163; 0.00</span></li>
                        <li>Total <span class="cart_price">&#163; 0.00</span></li>
                    </ul>
                    <a href="/clothmax/pages/checkout.php" class="primary-btn checkoutBtn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

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

		load_cart_details();
		//load_cart()

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
					$('.total_price_hidden').val(data.total_price_hidden);
					$('.subtotal').html(data.total_price);
					$('.total').html(data.total_price);
					$('.total_price_hidden').val(data.total_price_hidden);
				}
			});
		}

		function load_cart_details(){
			$.ajax({
				url: "../config/AjaxHandler.php",
				method: "POST",
				data: 'action=cart_details',
				success:function(response){
					//load_cart();
					$('.cart_details').html(response);
				}
			});
		}

		$(document).on("change keyup", ".qty_box", function(){
		var new_qty = $(this).val();
		var product_id = $(this).parent().parent().parent().parent().attr("id");
		var action = "update_cart";

			$.ajax({
				url: "../config/AjaxHandler.php",
				method: "POST",
				data: {new_qty:new_qty, product_id:product_id, action:action},
				beforeSend:function()
				{
				$('.empty_cart').addClass('disabled');
				$('.checkoutBtn').addClass('disabled');

				},
				success:function(response){
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
                  $('.empty_cart').removeClass('disabled');
				  $('.checkoutBtn').removeClass('disabled');
                  load_cart();
                  load_cart_details();
                },
			});
		});

		$(document).on("click", ".cart__close",  function(){
		var product_id = $(this).attr("id");
		var action = "remove";

			if (confirm("Are you sure you want to remove this product?")) 
			{

				$.ajax({
					url: "../config/AjaxHandler.php",
					method: "POST",
					data: {product_id:product_id, action:action},
					beforeSend:function()
					{
					$('.empty_cart').addClass('disabled');
					$('.checkoutBtn').addClass('disabled');
					},
					success:function(response)
					{
						let data = $.parseJSON(response);
	                    if(data.status==1){
	                      Toast.fire({
	                        icon: 'error',
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
	                  $('.empty_cart').removeClass('disabled');
					  $('.checkoutBtn').removeClass('disabled');
	                  load_cart();
	                  load_cart_details();
	                },
				});
			}

		});

		$(document).on("click", ".empty_cart", function(e){
			e.preventDefault();
			var action = "empty_cart";

			$.ajax({
				url: "../config/AjaxHandler.php",
				method: "POST",
				data: {action:action},
				beforeSend:function()
				{
				$('.empty_cart').addClass('disabled');
				$('.checkoutBtn').addClass('disabled');
				},
				success:function(response)
				{
					let data = $.parseJSON(response);
                    if(data.status==1){
                      Toast.fire({
                        icon: 'error',
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
                  $('.empty_cart').removeClass('disabled');
				  $('.checkoutBtn').removeClass('disabled');
                  load_cart();
                  load_cart_details();
                },

			});

		});

	});
</script>