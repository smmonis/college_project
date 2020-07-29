<?php    
    session_start();

    include 'config.php';

    if(isset($_SESSION['cart'])):        
        $check_out = $_SESSION['cart'];

    else:
        $check_out = array();

    endif;

    if(empty($_SESSION['signin'])):
        header('Location: login.php');

    endif;

    if(isset($_POST['place_order'])):
        $first = $_POST['first'];
        $last = $_POST['last'];
        $cun_name = $_POST['cun_name'];
        $cun = $_POST['cun'];
        $street = $_POST['street'];
        $zip = $_POST['zip'];
        $town = $_POST['town'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $counter = 0;

        foreach ($check_out as $key => $value):
            $order = "INSERT INTO orders (Product_SKU, Product_Quantity, First_Name, Last_Name, Company_Name, Country, Address, Zip, City, Email, Phone) VALUES ('".$value['Product_SKU']."', '".$value['Product_quantity']."', '$first', '$last', '$cun_name', '$cun', '$street', '$zip', '$town', '$email', '$phone')";

            if(mysqli_query($connection,$order)):
                if($counter == 1):
                    echo "<script type='text/javascript'>alert('Order Placed!');</script>";

                endif;
                $counter++;
                //header("Location: form.php");

            else:
                echo "Error: " . $order . "<br>" . mysqli_error($connection);
                //header("Location: form.php");

            endif;
        endforeach;

    endif;

    include 'header.php';
?>

<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="filter.js"></script>

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="" method="POST" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- <div class="checkout-content">
                            <a href="#" class="content-btn">Click Here To Login</a>
                        </div> -->

                        <?php
                        if(empty($check_out)):
                            echo "No item(s) in the cart to go for Billing Process!!";

                        else:
                            echo "<h4>Billing Details</h4>
                                <div class='row'>
                                <div class='col-lg-6'>
                                <label for='fir'>First Name<span>*</span></label>
                                <input type='text' id='fir' name='first'>
                            </div>
                            <div class='col-lg-6'>
                                <label for='last'>Last Name<span>*</span></label>
                                <input type='text' id='last' name='last'>
                            </div>
                            <div class='col-lg-12'>
                                <label for='cun-name'>Company Name</label>
                                <input type='text' id='cun-name' name='cun_name'>
                            </div>
                            <div class='col-lg-12'>
                                <label for='cun'>Country<span>*</span></label>
                                <input type='text' id='cun' name='cun'>
                            </div>
                            <div class='col-lg-12'>
                                <label for='street'>Street Address<span>*</span></label>
                                <input type='text' id='street' class='street-first' name='street'>
                                <input type='text'>
                            </div>
                            <div class='col-lg-12'>
                                <label for='zip'>Postcode / ZIP (optional)</label>
                                <input type='number' id='zip' name='zip'>
                            </div>
                            <div class='col-lg-12'>
                                <label for='town'>Town / City<span>*</span></label>
                                <input type='text' id='town' name='town'>
                            </div>
                            <div class='col-lg-6'>
                                <label for='email'>Email Address<span>*</span></label>
                                <input type='text' id='email' name='email'>
                            </div>
                            <div class='col-lg-6'>
                                <label for='phone'>Phone<span>*</span></label>
                                <input type='number' id='phone' name='phone'>
                            </div>
                            <div class='col-lg-12'>
                                <div class='create-item'>
                                    <label for='acc-create'>
                                        Create an account?
                                        <input type='checkbox' id='acc-create'>
                                        <span class='checkmark'></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='col-lg-6'>
                        <div class='checkout-content'>
                            <input type='text' placeholder='Enter Your Coupon Code'>
                        </div>
                        <div class='place-order'>
                            <h4>Your Order</h4>
                            <div class='order-total'>
                                <ul class='order-table'>
                                    <li>Product <span>Total</span></li>";?>
                                    
                                    <?php foreach ($check_out as $key => $value):
                                        echo "<li class='fw-normal'>".$value['Product_Name']." x ".$value['Product_quantity']." <span>$".$value['Price'].".00</span></li>";endforeach;?>

                                    <?php echo "<li class='fw-normal'>Subtotal <span class='st'></span></li>
                                    <li class='total-price'>Total <span class='ct'></span></li>
                                </ul>
                                <div class='payment-check'>
                                    <div class='pc-item'>
                                        <label for='pc-check'>
                                            Cheque Payment
                                            <input type='checkbox' id='pc-check'>
                                            <span class='checkmark'></span>
                                        </label>
                                    </div>
                                    <div class='pc-item'>
                                        <label for='pc-paypal'>
                                            Paypal
                                            <input type='checkbox' id='pc-paypal'>
                                            <span class='checkmark'></span>
                                        </label>
                                    </div>
                                </div>
                                <div class='order-btn'>
                                    <button type='submit' name='place_order' class='site-btn place-btn'>Place Order</button>
                                </div>
                            </div>
                        </div>";endif;?>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Partner Logo Section Begin -->
    <div class="partner-logo">
        <div class="container">
            <div class="logo-carousel owl-carousel">
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-1.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-2.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-3.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-4.png" alt="">
                    </div>
                </div>
                <div class="logo-item">
                    <div class="tablecell-inner">
                        <img src="img/logo-carousel/logo-5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Partner Logo Section End -->

    <?php include 'footer.php';?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.zoom.min.js"></script>
    <script src="js/jquery.dd.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>