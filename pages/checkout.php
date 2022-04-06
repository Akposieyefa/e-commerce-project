<?php
require_once("../config/initialize.php");

use app\config\Connection;
use app\classes\Cart;

$pdo = new Connection();

$cart = new Cart($pdo);


require_once('../theme/header.php');
?>
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="/clothmax/">Home</a>
                            <a href="/clothmax/pages/shop.php">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form id="order_form">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Please take a moment to make sure everything looks good before placing your order.</h6>
                            <h6 class="checkout__title">Delivery Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="firstName" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastName" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" placeholder="Street Address" class="checkout__input__add" required>
                                <input type="text" name="optional_address" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" id="" required>
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input type="text" class="state" name="state" required>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <select class="form-control country select2" name="country" style="width: 100%;" required>
                                    <?php $countries = $cart->load_country();  
                                    foreach ($countries as $country): ?>
                                        <option value='<?= $country->id; ?>'><?= $country->name; ?></option>
                                    <?php  endforeach;
                                 ?>
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc" class="create_account" name="createAccount" value="createAccount">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            </div>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text" name="password">
                            </div>
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input type="text" name="notes"
                                placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span class="cart_price">&#163;0.00</span></li>
                                    <li>Total <span class="cart_price">&#163;0.00</span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or" class="create_account" name="createAccount" value="createAccount">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Credit card
                                        <input type="radio" id="payment" name="payment" value="1" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="radio" id="paypal" name="payment" value="2">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn order-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-centre">Login</h3>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" id="checkoutFormLogin">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">E-Mail Address</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="loginEmail" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="loginPassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-success loginBtn">Login</button>

                            <a class="btn btn-link" href="/clothmax/pages/signup.php">Create an Account?</a>
                        </div>
                    </div>
                </form>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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

    // Initialize Select2 Elements
    $('.select2').select2();

        load_checkout();

        function load_checkout()
        {
            var action = 'checkout';

            $.ajax({
                url: "../config/AjaxHandler.php",
                method: "POST",
                data: {action:action},
                success:function(response)
                {
                    let data = $.parseJSON(response);
                        if(data.status==3){
                          location.replace('/clothmax/pages/shop.php');
                    }

                    $('.checkout__total__products').html(response);
                    
                }
            });
        }


        $(document).on('click', '.order-btn', function(e){
           e.preventDefault();

           if($('input[name="firstName"]').val() == ''){
                return false;
           } 
           if($('input[name="lastName"]').val() == ''){
                return false;
           }
           if($('input[name="address"]').val() == ''){
                return false;
           } 
           if($('input[name="city"]').val() == ''){
                return false;
           } 
           if($('input[name="state"]').val() == ''){
                return false;
           }
           if($('input[name="country"]').val() == ''){
                return false;
           } 
           if($('input[name="zip"]').val() == ''){
                return false;
           } 
           if($('input[name="phone"]').val() == ''){
                return false;
           } 
           if($('input[name="email"]').val() == ''){
                return false;
           }

            var formdata= $('form').serialize();

           if($("input[name='createAccount']").is(":checked")){

                $("input[name='createAccount']").attr("checked", true);
                $("input[name='password']").attr("required", true);

                var total_price = $('.cart_price').html();

                const formdata = $("#order_form").serialize();
                const postdata = formdata+"&action=place_order_acct&total_price="+total_price;

                $.ajax({
                    url: "../config/AjaxHandler.php",
                    method: "POST",
                    data: postdata,
                    beforeSend:function()
                    {
                    $('.order-btn').addClass('disabled');
                    },
                    success:function(response){
                        let data = $.parseJSON(response);
                        if(data.status==1){
                          Toast.fire({
                            icon: 'success',
                            title: data.message
                          });
                          setTimeout(function() { 
                            location.replace('/clothmax/pages/order.php');
                          }, 5000);
                          //$('span').html('Something went wrong, try again!');
                        }else if(data.status==2){
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            setTimeout(function() { 
                            location.reload();
                          }, 5000);
                        }
                        else{
                          Toast.fire({
                            icon: 'error',
                            title: data.message
                            });

                          setTimeout(function() { 
                            //location.reload();
                          }, 5000);
                        }
                    },
                    error:function(){
                      alert('Whoops! This didn\'t work. Please contact us.')
                    },
                    complete: function() {
                      $('.order-btn').removeClass('disabled');
                    },
                });                

           }else{

                $("input[name='password']").attr("required", false);

                var total_price = $('.cart_price').html();

                const formdata = $("#order_form").serialize();
                const postdata = formdata+"&action=place_order&total_price="+total_price;

                $.ajax({
                    url: "../config/AjaxHandler.php",
                    method: "POST",
                    data: postdata,
                    beforeSend:function()
                    {
                    $('.order-btn').addClass('disabled');
                    },
                    success:function(response){
                        let data = $.parseJSON(response);
                        if(data.status==1){
                          Toast.fire({
                            icon: 'success',
                            title: data.message
                          });
                          setTimeout(function() { 
                            location.replace('/clothmax/pages/order.php');
                          }, 5000);
                          //$('span').html('Something went wrong, try again!');
                        }
                        else if(data.status==2){
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                            setTimeout(function() { 
                            location.reload();
                          }, 5000);
                        }
                        else{
                          Toast.fire({
                            icon: 'error',
                            title: data.message
                            });

                          setTimeout(function() { 
                            $('#myModal').modal('show');
                            //location.reload();
                          }, 5000);
                        }
                    },
                    error:function(){
                      alert('Whoops! This didn\'t work. Please contact us.')
                    },
                    complete: function() {
                      $('.order-btn').removeClass('disabled');
                    },
                });  

           }
        });

        $(".loginBtn").click(function(e){
            e.preventDefault();

             if($('input[name="loginEmail"]').val() == ''){
                return false;
               } 
               if($('input[name="loginPassword"]').val() == ''){
                    return false;
               }

            var formdata = $("#checkoutFormLogin").serialize();

            var postdata = formdata+"&action=login";

            //Ajax
            $.ajax({
                url: "../config/AjaxHandler.php",
                method: "POST",
                data: postdata,
                beforeSend:function()
                {
                $('.loginBtn').addClass('disabled');
                },
                success:function(response){
                    let data = $.parseJSON(response);
                    if(data.status==1){
                      Toast.fire({
                        icon: 'success',
                        title: data.message
                      });
                      setTimeout(function() { 
                        location.reload();
                      }, 5000);
                      //$('span').html('Something went wrong, try again!');
                    }else{
                      Toast.fire({
                        icon: 'error',
                        title: data.message
                        });                      
                    }
                },
                error:function(){
                  alert('Whoops! This didn\'t work. Please contact us.')
                },
                complete: function() {
                  $('.loginBtn').removeClass('disabled');
                },
            })
        });

    });
</script>