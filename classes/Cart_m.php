<?php
namespace app\classes;

/**
 * 
 */
use app\config\Functions;

class Cart_m
{

    public function add_carts($value='')
    {
        $functions = new functions();

        if (isset($_SESSION['shopping_cart'])) 
        {
            $is_available = 0;
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if ($_SESSION["shopping_cart"][$keys]['product_id'] == $value["product_id"])
                {
                    $is_available++;
                    $qty = $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $value["product_qty"];

                    $product_id = $value['product_id'];
                    $ip = $functions->getIp();
                    $user_agent =  $_SERVER['HTTP_USER_AGENT'];
                    //$qty =  $_SESSION["shopping_cart"][$keys]['product_quantity'] + $_POST["hidden_quantity"];

                    //Update the cart db
                    $stmt = $this->pdo->preparedStatement("UPDATE cart SET qty='$qty' WHERE productID='$product_id' AND ip_add='$ip' AND browser='$user_agent'");
                    
                    $functions->json('1', 'Item Added to Cart.');
                }
            }
            if ($is_available == 0) {


                $item_array = array(
                    'product_id'    =>  $value["product_id"],
                    'SKU'   =>  $value["sku"],
                    'product_title' =>  $value["product_name"],
                    'each_price'    =>  $value["product_price"],
                    'product_price' =>  $value["product_price"],
                    'product_size' =>  $value["product_size"],
                    'product_color' =>  $value["product_color"],
                    'product_desc'  =>  $value['product_desc'],
                    'product_image'     =>  $value['product_image'],
                    'product_quantity'  =>  $value["product_qty"],
                    'procduct_cat'  =>  $value['product_category']
                );
                $_SESSION["shopping_cart"][] = $item_array;

                $product_id = $value['product_id'];
                $ip = $functions->getIp();
                $user_agent =  $_SERVER['HTTP_USER_AGENT'];
                $qty =  $value['product_qty'];

                //Insert the cart db
                $stmt = $this->pdo->preparedStatement("INSERT INTO cart (productID, ip_add, browser, qty) VALUES ('$product_id','$ip','$user_agent','$qty')");
               
                $functions->json('1', 'Item Added to Cart.');
            }

        }
        else{

            $product_id = $value['product_id'];
            $ip = $functions->getIp();
            $user_agent =  $_SERVER['HTTP_USER_AGENT'];
            $qty =  $value['product_qty'];

            //Insert the cart db
            $stmt = $this->pdo->preparedStatement("INSERT INTO cart (productID, ip_add, browser, qty) VALUES ('$product_id','$ip','$user_agent','$qty')");

           // $product_stmt = $this->pdo->preparedStatement("SELECT * FROM products WHERE productID='{$value["product_id"]}'")
                    
                $item_array = array(
                    'product_id'    =>  $value["product_id"],
                    'SKU'   =>  $value["sku"],
                    'product_title' =>  $value["product_name"],
                    'each_price'    =>  $value["product_price"],
                    'product_price' =>  $value["product_price"],
                    'product_size' =>  $value["product_size"],
                    'product_color' =>  $value["product_color"],
                    'product_desc'  =>  $value['product_desc'],
                    'product_image'     =>  $value['product_image'],
                    'product_quantity'  =>  $value["product_qty"],
                    'procduct_cat'  =>  $value['product_category']
                );
                $_SESSION["shopping_cart"][] = $item_array;

        
            $functions->json('1', 'Item Added to Cart.');
        }
    }

    public function update_carts($value='')
    {
       $functions = new functions();

        $id = $value['product_id'];
        $new_qty = intval($value['new_qty']);

        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            if($values['product_id'] == $id)
            {
                //echo $values['product_id'];
                $_SESSION['shopping_cart'][$keys]['product_quantity'] = $new_qty;

                $ip =  $functions->getIp();
                $user_agent =  $_SERVER['HTTP_USER_AGENT'];

                //Update the cart db
                $stmt = $this->pdo->preparedStatement("UPDATE cart SET qty ='$new_qty' WHERE productID='id' AND ip_add='$ip' AND browser='$user_agent'");
               
               $functions->json('1', 'Cart Updated');
            }
        }
    }

    public function remove_carts($value='')
    {
        $functions = new functions();

        foreach ($_SESSION['shopping_cart'] as $keys => $values) 
        {
            if ($values['product_id'] == $value['product_id']) 
            {
                unset($_SESSION['shopping_cart'][$keys]);
                $ip = $functions->getIp();
                $user_agent =  $_SERVER['HTTP_USER_AGENT'];
                $stmt = $this->pdo->preparedStatement("DELETE FROM cart WHERE productID='{$value["product_id"]}' AND ip_add='$ip' AND browser='$user_agent'");

               $functions->json('1', 'Item removed');
            }
        }
    }

    public function empty_carts($value='')
    {
        $functions = new functions();

        if ($value['action'] == "empty_cart") 
        {
            unset($_SESSION['shopping_cart']);
            unset($_SESSION['total_item']);
            $ip = $functions->getIp();
            $user_agent =  $_SERVER['HTTP_USER_AGENT'];
            $stmt = $this->pdo->preparedStatement("DELETE FROM cart WHERE ip_add='$ip' AND browser='$user_agent'");
           
           $functions->json('1', 'Your cart has been cleared');
        }
        elseif($value['action'] == 'empty_cart_checkout')
        {
            unset($_SESSION['shopping_cart']);
            unset($_SESSION['total_item']);
            $ip = $functions->getIp();
            $user_agent =  $_SERVER['HTTP_USER_AGENT'];
            $stmt = $this->pdo->preparedStatement("DELETE FROM cart WHERE ip_add='$ip' AND browser='$user_agent'");
        }
    }

    public function fetch_carts($value='')
    {
        $total_item = 0;
        $total_price = 0;

        if(!empty($_SESSION["shopping_cart"]))
        {
            foreach ($_SESSION["shopping_cart"] as $keys => $values) 
            {
                
                $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
                $total_item = $total_item + 1;
            }

            $data = array(
                'total_item'    =>  $total_item,
                'total_price'   =>  '&#163;' . number_format($total_price, 2),
                'total_price_hidden'    =>  $total_price
            );
            echo json_encode($data);
            $_SESSION['total_item'] = $total_item;
        }

    }

    public function load_checkouts($value='')
    {
       $functions = new functions();

        $total_price = 0;

        if(!empty($_SESSION["shopping_cart"]))
        {
            $output = '';
            $i=1;
            foreach ($_SESSION["shopping_cart"] as $keys => $values) 
            {
            
                $total_price = $total_price + ($values["product_quantity"] * $values["each_price"]);

               $output .= '<li>'.$i++.'. '.ucwords($values['product_title']).' <span>&#163;'.number_format($values["product_quantity"] * $values["each_price"], 2).'</span></li>';
            }

            echo $output;
        }else{
            $functions->json('3', 'Forbidden access');
        }
    }

    public function cart_details($value='')
    {
        $total_item = 0;
        $total_price = 0;
        if(!empty($_SESSION["shopping_cart"]))
        {
            $output = '';   
            foreach ($_SESSION["shopping_cart"] as $keys => $values) 
            {
                $total_price = $values["product_quantity"] * $values["each_price"];

                //$price = $total_price + ($values["product_quantity"] * $values["product_price"]);
                $output .= '<tr id="'.$values['product_id'].'" class="productId">';

                $output .= '<td class="product__cart__item">';

                $output .= '<div class="product__cart__item__pic">
                              <img src="/clothmax/assets/'.$values['product_image'].'" alt="product image" width="70" class="img-fluid rounded shadow-sm">
                            </div>';

                $output .= '<div class="product__cart__item__text">
                                <h6>'.ucwords($values['product_title']).'</h6>
                                <p><strong>color:</strong> '.ucwords($values['product_color']).'  &nbsp;&nbsp;<strong>size:</strong> '.ucwords($values['product_size']).'</p>
                                <h5>&#163;'.number_format($values['each_price'], 2).'</h5>
                            </div>
                            </td>';

                $output .= '<td class="quantity__item">
                                <div class="quantity">
                                    <div class="pro-qty-2">
                                        <input type="number" value="'.$values['product_quantity'].'" class="qty_box">
                                    </div>
                                </div>
                            </td>';

                $output .= '<td class="cart__price">&#163;'.number_format($total_price, 2).'</td>';

                $output .= '<td class="cart__close" id="'.$values['product_id'].'"><i class="fa fa-close"></i></td>';

                $output .= '</tr>';

                $output .= '<tr>';
                $output .= '<td class="border-0 align-right" colspan="7">';
                
                $output .= '</td>';
                $output .= '</tr>';

        }

        echo $output;
        
    }
    else
        {
            echo "<tr colspan='3' class='alert alert-warning' style='width:100%;'><td>Cart is empty</td></tr>";
        }
        ?>

        <script type="text/javascript">
            
            var proQty = $('.pro-qty-2');
            proQty.prepend('<span class="fa fa-angle-left dec qtybtn"></span>');
            proQty.append('<span class="fa fa-angle-right inc qtybtn"></span>');
            proQty.on('click', '.qtybtn', function () {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find('input').val(newVal);
            });
        </script>
    <?php
    }

    public function load_countries($value='')
    {

        $output = $this->pdo->preparedStatement("SELECT * FROM countries")->fetchAll();

        return $output;
    }

    public function paymentType($id='')
    {
        if($id === FALSE){
            $stmt = $this->pdo->preparedStatement("SELECT * FROM `paymenttype`");
            return $stmt->fetchAll();
        }

        $stmt = $this->pdo->preparedStatement("SELECT * FROM `paymenttype` WHERE `id`=?", $id);
        return $paymenttype =  $stmt->fetch();
    }

    public function place_orders($value='')
    {
        
        $functions = new functions();

        if(!isset($_SESSION['loggedin'])){
            $functions->json('3', 'Forbidden accesss, Please signin or create a new account to complete your order', 'signin.php');
        }

        if(!empty($_SESSION["shopping_cart"]))
        {
           if($value['password'] == ''){

              /*  `order_id`, `payment_id`, `c_id`, `ip`, `totalAmount`, `orderAddress`, `addInfo`, `orderContactName`, `shippingDate`, `status`, `PaymentStatus`, `order_date`, `update_date`, `orderCity`, `orderState`, `orderPhone`, `Exphone*/

            $order_id = time();
            $payment_id = $this->paymentType([$value['payment']])->id;
            $cust_id = $_SESSION['cust_user_id'] ?? '0';
            $ip = $functions->getIp();
            $totalAmount = $value['total_price'];
            $address = $value['address'];
            $addInfo = $value['note'] ?? 'Null';
            $orderContactName = $value['firstName'].' '.$value['lastName'];
            $status = 'completed';
            $orderCity = $value['city'];
            $orderState = $value['state'];
            $orderPhone = $value['phone'];

            $stmt = $this->pdo->preparedStatement("INSERT INTO orders (order_id, payment_id, c_id, ip, totalAmount, orderAddress, addInfo, orderContactName, status, orderCity, orderState, orderPhone) VALUES ('$order_id','$payment_id','$cust_id','$ip','$totalAmount','$address','$addInfo','$orderContactName','$status','$orderCity','$orderState','$orderPhone')");

                $totalAmount = 0;
                $lastInsertId = $this->pdo->lastInsertId();

                foreach ($_SESSION["shopping_cart"] as $key => $values) {

                    $name = $functions->trackId($values['product_title']);
                    $track_id = strtoupper($name.''.$values["product_size"]).''.time();
                    $status = 'completed';

                    $totalAmount = number_format($values["product_quantity"] * $values["each_price"], 2);

                    $this->pdo->preparedStatement("INSERT INTO `orderdetail`(`orderID`, `track_id`, `productID`, `price`, `qty`,`total`, `color`, `size`, `status`, `PaymentStatus`) VALUES ('$lastInsertId','$track_id','{$values["product_id"]}','{$values["product_price"]}','{$values["product_quantity"]}','$totalAmount','{$values["product_color"]}','{$values["product_size"]}','$status','$status')");
                    
                }

                $data = array(
                    'status'    =>  1,
                    'message'   =>  'Order placed'
                );
                echo json_encode($data);

                $value['action'] = "empty_cart_checkout";
                $this->empty_carts($value);

           }else{
                $functions->json('0', 'Failed');
           }
        }else{
            $functions->json('0', 'Failed');
        }
    }

    // function to place order and create user account with checkout details
    public function place_order_accts($cust_id='',$value='')
    {
        $functions = new Functions();

        if(isset($_SESSION['loggedin'])){
            $functions->json('2', 'You are loggedin');
        }

         if(!empty($_SESSION["shopping_cart"])){

           if($value['password'] != ''){

              /*  `order_id`, `payment_id`, `c_id`, `ip`, `totalAmount`, `orderAddress`, `addInfo`, `orderContactName`, `shippingDate`, `status`, `PaymentStatus`, `order_date`, `update_date`, `orderCity`, `orderState`, `orderPhone`, `Exphone*/

            $order_id = time();
            $payment_id = $this->paymentType([$value['payment']])->id;
            //$cust_id = $_SESSION['cust_user_id'] ?? '0';
            $ip = $functions->getIp();
            $totalAmount = $value['total_price'];
            $address = $value['address'];
            $email = $value['email'];
            $addInfo = $value['note'] ?? 'Null';
            $orderContactName = $value['firstName'].' '.$value['lastName'];
            $status = 'completed';
            $orderCity = $value['city'];
            $orderState = $value['state'];
            $orderCountry = $value['country'];
            $orderPhone = $value['phone'];
            $password = $value['password'];

           /*if($this->pdo->preparedStatement("INSERT INTO `customers` (`customer_ip`, `customer_firstName`, `customer_lastName`, `customer_email`, `customer_pass`, `customer_country`, `customer_state`, `customer_city`, `customer_contact`, `customer_address`) VALUES ('$ip', '{$value["firstName"]}', '{$value["lastName"]}', '$email', '$password', '$orderCountry', '$orderState', '$orderCity', '$orderPhone', '$address')")){

                $lastCustomerInsertId = $this->pdo->lastInsertId();
           }*/

            $stmt = $this->pdo->preparedStatement("INSERT INTO orders (order_id, payment_id, c_id, ip, totalAmount, orderAddress, addInfo, orderContactName, status, orderCity, orderState, orderCountry, orderPhone) VALUES ('$order_id','$payment_id','$cust_id','$ip','$totalAmount','$address','$addInfo','$orderContactName','$status','$orderCity','$orderState','$orderCountry','$orderPhone')");

                $totalAmount = 0;
                $lastInsertId = $this->pdo->lastInsertId();

                foreach ($_SESSION["shopping_cart"] as $key => $values) {

                    $name = $functions->trackId($values['product_title']);
                    $track_id = strtoupper($name.''.$values["product_size"]).''.time();
                    $status = 'completed';

                    $totalAmount = number_format($values["product_quantity"] * $values["each_price"], 2);

                    $this->pdo->preparedStatement("INSERT INTO `orderdetail` (`orderID`, `track_id`, `productID`, `price`, `qty`,`total`, `color`, `size`, `status`, `PaymentStatus`) VALUES ('$lastInsertId','$track_id','{$values["product_id"]}','{$values["product_price"]}','{$values["product_quantity"]}','$totalAmount','{$values["product_color"]}','{$values["product_size"]}','$status','$status')");
                    
                }

                /*customer_ip`, `customer_firstName`, `customer_lastName`, `customer_email`, `customer_pass`, `customer_country`, `customer_state`, `customer_city`, `customer_contact`, `customer_address`*/

                $data = array(
                    'status'    =>  1,
                    'message'   =>  'Order placed'
                );
                echo json_encode($data);

                $value['action'] = "empty_cart_checkout";
                $this->empty_carts($value);

           }else{
                $functions->json('0', 'Failed');
           }
        }else{
            $functions->json('0', 'Failed');
        }
    }

} // Class