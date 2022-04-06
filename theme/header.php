<?php
if (file_exists ("../config/initialize.php")) {
   require_once("../config/initialize.php");
}else{
    require_once("config/initialize.php");
}

$pg = basename(substr($_SERVER['PHP_SELF'],0,strrpos($_SERVER['PHP_SELF'],'.')));

use app\config\Session;

$session = new Session();


?><!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cloth_Max Store">
    <meta name="keywords" content="Cloth_Max, sports, sport wears, joggers">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cloth-Max | Home</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/clothmax/assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/clothmax/assets/css/style.css" type="text/css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/clothmax/assets/css/sweetalert2.min.css">
  <link rel="stylesheet" href="/clothmax/assets/css/bootstrap-4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="/clothmax/assets/css/select2.min.css">
  <link rel="stylesheet" href="/clothmax/assets/css/select2-bootstrap4.min.css">
  <!-- DataTable -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin Mobile -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="/clothmax/pages/signin.php">Sign in</a>
                <a href="/clothmax/pages/faq.php">FAQs</a>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="/clothmax/assets/img/icon/search.png" alt=""></a>
            <a href="#"><img src="/clothmax/assets/img/icon/heart.png" alt=""></a>
            <a href="/clothmax/pages/shopping-cart.php"><img src="/clothmax/assets/img/icon/cart.png" alt=""> <span class="cart_count">0</span></a>
            <div class="price cart_price">&#163;0.00</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, shop online 24/7.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Free shipping, shop online 24/7.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <?= isset($_SESSION['loggedin']) ? '<a href="/clothmax/pages/profile.php">My Account</a>' : '<a href="/clothmax/pages/signin.php">Sign in</a>' ; ?>
                                
                                <?= isset($_SESSION['loggedin']) ? '<a href="/clothmax/pages/logout.php">logout</a>' : '' ; ?>
                                <a href="/clothmax/pages/faq.php">FAQs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="/clothmax/"><img src="/clothmax/assets/img/logo.jpg" alt=""></a>
                       <!--  <a href="./index.html">Cloth-Max</a> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="<?php if ($pg == 'index'): 
                                echo 'active';
                            endif;
                             ?>"><a href="/clothmax/index.php">Home</a></li>

                            <li class="<?php if ($pg == 'shop'): 
                                echo 'active';
                            endif;
                             ?>"><a href="/clothmax/pages/shop.php">Shop</a></li>
                            <li class="<?php if ($pg == 'about'): 
                                echo 'active';
                            endif;
                             ?>"><a href="#">About Us</a></li>
                            <li class="<?php if ($pg == 'blog'): 
                                echo 'active';
                            endif;
                             ?>"><a href="#">Blog</a></li>
                            <li <?php if ($pg == 'contact'): 
                                echo 'active';
                            endif;
                             ?>><a href="#">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="/clothmax/assets/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="/clothmax/assets/img/icon/heart.png" alt=""></a>
                        <a href="/clothmax/pages/shopping-cart.php"><img src="/clothmax/assets/img/icon/cart.png" alt=""> <span class="cart_count">0</span></a>
                        <div class="price cart_price">&#163;0.00</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->