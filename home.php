<?php

    require_once 'packages/database.php';
    $utilize = new Database();
    $fetch_category = $utilize->displayCategory();

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
    <title>Store</title>


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
        <a class="search" title="search" href="search_page.php"><i class="fas fa-search"></i></a>
        <a class="cart position-relative" title="wishlist" href="wishlist.php"><i class="fas fa-heart"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger caw" style="font-size: 6pt;">
        
            <span class="visually-hidden">unread messages</span>
        </span>
        </a>
        <a class="favorite position-relative" href="cart.php" title="cart"><i class="fas fa-cart-plus"></i>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cac" style="font-size: 6pt;">
        
            <span class="visually-hidden">unread messages</span>
        </span>
        </a>
        <div class="profile"><i class="fas fa-user"></i></div>
        
    </div>

    <div class="user-link">
    
    </div>
</div>
<!-- <div id="alertAdded"></div> -->

<div class="home-bg">
    <div class="swiper home">
        <div class="swiper-wrapper">
        <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/home-img-1.png" alt="">
                </div>
                <div class="content">
                    <p>upto 50% off</p>
                    <h1>lastest smartphones</h1>
                    <a href="shop.php" class="btn btn-primary">Shop Now</a>
                </div>
        </div>
            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/home-img-2.png" alt="">
                </div>
                <div class="content">
                    <p>upto 50% off</p>
                    <h1>lastest smartphones</h1>
                    <a href="shop.php" class="btn btn-primary">Shop Now</a>
                </div>
        </div>
        <div class="swiper-slide slide">
            <div class="image">
                <img src="images/home-img-3.png" alt="">
            </div>
            <div class="content">
                <p>upto 50% off</p>
                <h1>lastest smartphones</h1>
                <a href="shop.php" class="btn btn-primary">Shop Now</a>
            </div>
        </div>
        
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
  <h1 class="heading">shop by category</h1>
<section class="home-category">
    <div class="swiper main-slide">
        <div class="swiper-wrapper">
            <?php 
                foreach($fetch_category as $row){
                    ?>
                    <a href="category.php?category=<?= $row['slug']; ?>" class="swiper-slide slide">
                        <img src="image_uploaded/category/<?= $row['image']; ?>" alt="">
                        <h3><?= $row['name']; ?></h3>
                    </a>
                    <?php
                }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<h1 class="heading">lastest products</h1>
<div id="alert"></div>
<section class="home-product">
    <div class="swiper main-box">
        <div class="swiper-wrapper" id="displayPro">
            <div class="d-flex align-items-center">
                <strong>Loading...</strong>
                
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    
</section>

<div class="footer">
    <div class="sub-link">
        <h4>quick links</h4>
        <ul>
            <li><a href="home.php"><i class="fas fa-chevron-right"></i><span>home</span></a></li>
            <li><a href="about.php"><i class="fas fa-chevron-right"></i><span>about</span></a></li>
            <li><a href="shop.php"><i class="fas fa-chevron-right"></i><span>shop</span></a></li>
            <li><a href="contact.php"><i class="fas fa-chevron-right"></i><span>contact</span></a></li>

        </ul>
    </div>
    <div class="sub-link">
        <h4>extra links</h4>
        <ul>
            <li><a href="login.php"><i class="fas fa-chevron-right"></i><span>login</span></a></li>
            <li><a href="register.php"><i class="fas fa-chevron-right"></i><span>register</span></a></li>
            <li><a href="cart.php"><i class="fas fa-chevron-right"></i><span>cart</span></a></li>
            <li><a href="orders.php"><i class="fas fa-chevron-right"></i><span>orders</span></a></li>
        </ul>
    </div>
    <div class="sub-link">
        <h4>contact us</h4>
        <ul>
            <li><a href="contact.php"><i class="fas fa-phone"></i><span>+123-456-789</span></a></li>
            <li><a href="contact.php"><i class="fas fa-phone"></i><span>+111 222 999</span></a></li>
            <li><a href="contact.php"><i class="fas fa-envelope"></i><span>Ratanak@gmail.com</span></a></li>
            <li><a href="contact.php"><i class="fas fa-map"></i><span>PP, Cambodia - 40544</span></a></li>
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
<!-- ALERTITY JS -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="js/script.js"></script>
   <script>
        $(document).ready(function(){
        displayProduct();
        function displayProduct(){
            $.ajax({
                url: "packages/process.php",
                method: "post",
                data: "fetch_products",
                success: function(res){
                    $('#displayPro').html(res);
                }
            })
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
       
           

        // end script 
        });
    </script>
</body>
</html>

