<?php
require_once("config/initialize.php");

use app\config\Connection;
use app\config\Pagination;
use app\classes\Shop;

$pdo = new Connection();
$pagination = new Pagination($pdo);

$shop = new Shop($pdo);

?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="/clothmax/assets/img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6></h6>
                                <h2>Men <br><span>T-shirt</span></h2>
                                <a href="/clothmax/pages/men-wear.php?category=men-tshirt" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="/clothmax/assets/img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6></h6>
                                <h2>Women <br><span>Bra</span></h2>
                                <a href="/clothmax/pages/women-wear.php?category=bra" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="/clothmax/assets/img/hero/hero-3.png">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6></h6>
                                <h2>Pro <br><span>Boxing Glove<span></h2>
                                <a href="/clothmax/pages/shop-details.php?product=boxing-gloves" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="/clothmax/assets/img/banner/banner-1.png" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Men's Wear</h2>
                            <a href="/clothmax/pages/men-wear.php">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="/clothmax/assets/img/banner/banner-3.png" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Accessories</h2>
                            <a href="/clothmax/pages/accessories.php">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="/clothmax/assets/img/banner/banner-2.png" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Women's Wear</h2>
                            <a href="/clothmax/pages/women-wear.php">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-arrivals">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".hot-arrivals">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                <?php 
                if($shop->get_shop()):
                    $shops = $shop->get_shop();

                foreach($shops as $shop):
                    if($shop->trend != ''):
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix <?= $shop->trend; ?>-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/clothmax/assets/<?= $shop->productPicture; ?>">
                            <span class="label"><?= $shop->trend; ?></span>
                            <ul class="product__hover">
                                <li><a href="#"><img src="/clothmax/assets/img/icon/heart.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <?= '<h6><a href="/clothmax/pages/shop-details.php?product='.$shop->productSlug.'">'.ucwords($shop->productName).'</a></h6>'; ?>
                            <!-- <a href="#" class="add-cart">+ Add To Cart</a> -->
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>&#163;<?= number_format($shop->productUnitPrice, 2); ?></h5>
                        </div>
                    </div>
                </div>
            <?php endif; endforeach; endif; ?>
                
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Sport Max <br /> <span>Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="/clothmax/assets/img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5>&#163;29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="/climax/campaign.php?product=Multi-pocket Chest Bag Black&discountprice=29.99" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="/clothmax/assets/img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="/clothmax/assets/img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="/clothmax/assets/img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="/clothmax/assets/img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="/clothmax/assets/img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="/clothmax/assets/img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                        <h3>#Cloth_Max</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <section class="latest spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Latest News</span>
                        <h2>Fashion New Trends</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="/clothmax/assets/img/blog/blog-1.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="/clothmax/assets/img/icon/calendar.png" alt=""> 16 February 2020</span>
                            <h5>What Curling Irons Are The Best Ones</h5>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="/clothmax/assets/img/blog/blog-2.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="/clothmax/assets/img/icon/calendar.png" alt=""> 21 February 2020</span>
                            <h5>Eternity Bands Do Last Forever</h5>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="/clothmax/assets/img/blog/blog-3.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="/clothmax/assets/img/icon/calendar.png" alt=""> 28 February 2020</span>
                            <h5>The Health Benefits Of Sunglasses</h5>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->

