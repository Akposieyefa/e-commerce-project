    <!-- Footer Section Begin -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="/clothmax/assets/img/footer-logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="/clothmax/assets/img/payment.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Shopping</h6>
                        <ul>
                            <li><a href="#">Clothing Store</a></li>
                            <li><a href="#">Trending Shoes</a></li>
                            <li><a href="#">Accessories</a></li>
                            <li><a href="#">Sale</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer__widget">
                        <h6>Customer Care</h6>
                        <ul>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Payment Methods</a></li>
                            <li><a href="#">Delivary</a></li>
                            <li><a href="#">Return & Exchanges</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <h6>NewLetter</h6>
                        <div class="footer__newslatter">
                            <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                            <form action="#">
                                <input type="text" placeholder="Your email">
                                <button type="submit"><span class="icon_mail_alt"></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="/clothmax/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/clothmax/assets/js/bootstrap.min.js"></script>
    <script src="/clothmax/assets/js/jquery.nice-select.min.js"></script>
    <script src="/clothmax/assets/js/jquery.nicescroll.min.js"></script>
    <script src="/clothmax/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/clothmax/assets/js/jquery.countdown.min.js"></script>
    <script src="/clothmax/assets/js/jquery.slicknav.js"></script>
    <script src="/clothmax/assets/js/mixitup.min.js"></script>
    <script src="/clothmax/assets/js/owl.carousel.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="/clothmax/assets/js/sweetalert2.min.js"></script>
    <script src="/clothmax/assets/js/main.js"></script>
    <!-- Select2 -->
    <script src="/clothmax/assets/js/select2.full.min.js"></script>
     <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        load_cart();

        function load_cart()
        {
            $.ajax({
                url: "/clothmax/config/AjaxHandler.php",
                method: "POST",
                dataType: "json",
                success:function(data)
                {
                    $('.cart_count').html(data.total_item);
                    $('.cart_price').html(data.total_price);
                }
            });
        }
    });
</script>
</body>

</html>