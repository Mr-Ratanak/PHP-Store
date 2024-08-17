<?php
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:user_login.php');
}
    
    require_once 'packages/database.php';
    $data = new Database();   
    $pid = $_GET['pid'];
    $fetch_view_detail = $data->getIdDetail('products',$pid);
    $cid = $fetch_view_detail['id']; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <title>Quick view</title>
</head>
<body>
<div class="navbar">
    <a class="logo" href="home.php"><span>KH.</span> Store</a>
    <nav>
        <ul>
            <li><a href="home.php">home</a></li>
            <li><a href="about.php">about</a></li>
            <li><a href="orders.php">orders</a></li>
            <li><a href="shop.php">shop</a></li>
            <li><a href="contact.php">contact</a></li>
        </ul>
    </nav>
    <div class="list">
        <span id="bar"><i class="fas fa-bars"></i></span>
        <a class="search" href="search_page.php"><i class="fas fa-search"></i></a>
        <a class="cart position-relative" href="wishlist.php"><i class="fas fa-heart"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger caw" style="font-size: 6pt;">
            
            <span class="visually-hidden">unread messages</span>
        </span>
        </a>
        <a class="favorite position-relative" href="cart.php"><i class="fas fa-cart-plus"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cac" style="font-size: 6pt;">
        
            <span class="visually-hidden">unread messages</span>
        </span>
        </a>
        <div class="profile"><i class="fas fa-user"></i></div>
        
    </div>

    <div class="user-link">
        <!-- <p>please login or register first!</p>
        <div class="flex">
            <a class="btn btn-warning" href="user_register.php">Register</a>
            <a class="btn btn-warning" href="user_login.php">Login</a>
        </div> -->
    </div>
</div>

       <h2 class="heading-quick mt-5">quick view</div>
    <?php 
       $select_detail = $data->getProDetails($cid);
        foreach($select_detail as $row){
            ?>
            <section class="main-view">
                <div class="view-image">
                    <img class="m-img" src="image_uploaded/<?= $row['image_01']; ?>" alt="">
                    <hr>
                    <div class="sub-image">
                        <img class="s-img" src="image_uploaded/<?= $row['image_01']; ?>" alt="">
                        <img class="s-img" src="image_uploaded/<?= $row['image_02']; ?>" alt="">
                        <img class="s-img" src="image_uploaded/<?= $row['image_03']; ?>" alt="">
                    </div>
                </div>
                <form action="#" method="post" id="add_tocart_form" class="view-detail">
                <input type="hidden" name="pid" id="pid" value="<?= $row['id']; ?>"> 
                <input type="hidden" name="image" id="image" value="<?= $row['image_01']; ?>"> 
                <input type="hidden" name="name" id="name" value="<?= $row['name']; ?>"> 
                <input type="hidden" name="price" id="price" value="<?= $row['price']; ?>">      
                <p class="title"><?= $row['name'] ?></p>
                <hr>
                    <div class="flex">
                        <div class="price">$<?= $row['price'] ?>/-</div>
                        <!-- <input class="qty" type="number" name="qty" id="qty" min="1" max="99" value="1"> -->
                        <div class="col-md-3">
                            <div class="input-group" style="width: 130px;">
                                <input type="button" class="input-group-text decrement-btn" value="-">
                                <input class="text-center form-control input-qty bg-white qty" type="number" name="qty" id="qty" min="1" max="99" value="1">
                                <input type="button" class="input-group-text increment-btn" value="+">
                            </div>
                        </div>
                    </div>
                <hr>
                <p class="description"><?= substr($row['details'],0,500) ?></p>
                <hr>
                <div class="flex-btn">
                    <button class="btn btn-primary addToCartBtn" name="add_to_cart" type="submit" ><i class="fas fa-shop"></i> Add To Cart</button>
                    <button class="btn btn-danger addToWishlistBtn" name="add_to_wishlist" type="submit"><i class="fas fa-heart"></i> Add To Wishlist</button>
                </div>
                </form>

            </section>
            <?php
        }

    ?>
   

<div class="footer">
    <div class="sub-link">
        <h4>quick links</h4>
        <ul>
            <li><a href="home.html"><i class="fas fa-chevron-right"></i><span>home</span></a></li>
            <li><a href="about.html"><i class="fas fa-chevron-right"></i><span>about</span></a></li>
            <li><a href="shop.html"><i class="fas fa-chevron-right"></i><span>shop</span></a></li>
            <li><a href="contact.html"><i class="fas fa-chevron-right"></i><span>contact</span></a></li>

        </ul>
    </div>
    <div class="sub-link">
        <h4>extra links</h4>
        <ul>
            <li><a href="login.html"><i class="fas fa-chevron-right"></i><span>login</span></a></li>
            <li><a href="register.html"><i class="fas fa-chevron-right"></i><span>register</span></a></li>
            <li><a href="cart.html"><i class="fas fa-chevron-right"></i><span>cart</span></a></li>
            <li><a href="orders.html"><i class="fas fa-chevron-right"></i><span>orders</span></a></li>
        </ul>
    </div>
    <div class="sub-link">
        <h4>contact us</h4>
        <ul>
            <li><a href="contact.html"><i class="fas fa-phone"></i><span>+123-456-789</span></a></li>
            <li><a href="contact.html"><i class="fas fa-phone"></i><span>+111 222 999</span></a></li>
            <li><a href="contact.html"><i class="fas fa-envelope"></i><span>Ratanak@gmail.com</span></a></li>
            <li><a href="contact.html"><i class="fas fa-map"></i><span>PP, Cambodia - 40544</span></a></li>
        </ul>
    </div>
    <div class="sub-link">
        <h4>follow us</h4>
        <ul>
            <li><a href="javascript=0;"><i class="fa-brands fa-meta"></i><span>facebook</span></a></li>
            <li><a href="javascript=0;"><i class="fa-brands fa-tiktok"></i><span>tiktok</span></a></li>
            <li><a href="javascript=0;"><i class="fa-brands fa-instagram"></i><span>instagram</span></a></li>
            <li><a href="javascript=0;"><i class="fa-brands fa-linkedin"></i><span>linkedin</span></a></li>
        </ul>
    </div>
</div>
<div class="copy-right"><p>© copyright @ 2023 <span>Ecommerce-store</span> | all right reserved!</p></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- ALERTITY JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <script>
    $(document).ready(function(){
        displayProfileUser();
        function displayProfileUser(){
            $.ajax({
                url: "packages/process.php",
                method: "post",
                data: "display-user",
                success: function(res){
                    $('.user-link').html(res);
                }
            });        
        }

        $(document).on('submit', '#add_tocart_form', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
            
            var submitButton = $(document.activeElement).attr('name');
                $.ajax({
                    url: "packages/process.php",
                    method: "post",
                    data: formData + "&submit_button="+submitButton,
                    success: function(res) {
                        if(res === 'user_exist'){
                            window.location= 'user_login.php';
                        }else{
                            if(res === 'wishlist_exist'){
                                alertify.warning('Product already to wishlist').dismissOthers();
                            }else if(res === 'cart_exist'){
                                alertify.warning('Product already to cart').dismissOthers();
                            }else{
                                alertify.success('Product added to successful!').dismissOthers();
                                displayAllCounWishlist();
                                displayAllCountCart();
                            }
                        }   
                    }
                });
    });

            displayAllCountCart();
            function displayAllCountCart(){
                $.ajax({
                    url: 'packages/process.php',
                    method: 'post',
                    data: "displaycarts",
                    success: function(res){
                        $('.cac').html(res);
                    }
                })
            }
            displayAllCounWishlist();
            function displayAllCounWishlist(){
                $.ajax({
                    url: 'packages/process.php',
                    method: 'post',
                    data: "displaywishlists",
                    success: function(res){
                        $('.caw').html(res);
                    }
                })
            }

// custom qty click 
            $('.increment-btn').click(function(e){
                e.preventDefault();
                var qty = $(this).closest('.main-view').find('.input-qty').val();
                var value = parseInt(qty,10);
                value = isNaN(value)? 0 : value;
                if(value < 10){
                    value++;
                    $(this).closest('.main-view').find('.input-qty').val(value);
                    
                }
            });
            $('.decrement-btn').click(function(e){
                e.preventDefault();
                var qty = $(this).closest('.main-view').find('.input-qty').val();
                var value = parseInt(qty,10);
                value = isNaN(value)? 0 : value;
                if(value > 1){
                    value--;
                    $(this).closest('.main-view').find('.input-qty').val(value);
                    
                }
            });

        // end script 
        });
    </script>
</body>
</html>