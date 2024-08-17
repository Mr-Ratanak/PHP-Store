<?php
    require_once 'packages/database.php';
    $utilize = new Database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <title>Store</title>
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
    
    
    <section class="about">
        <div class="about-image">
            <img src="images/about-img.svg" alt="">
        </div>
        <div class="flex">
            <h3>why choose us?</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda perferendis eveniet dignissimos at soluta illo alias ullam minus, esse ratione.</p>
            <a href="contact.php" class="btn btn-primary">Contact Us</a>
        </div>
    </section>
    <h2 class="heading">client's review</h2>
    <section class="swiper review myReview">
        <div class="swiper-wrapper">
            <div class="sub-rev swiper-slide">
                <div class="qoute"><i class="fa-solid fa-quote-left"></i></div>
                <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, voluptates.</p>
                <div class="wrap-rev">
                    <div class="sub-wrap">
                        <div class="name">nak ptm</div>
                        <span>Fullstack | Developer</span>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <img src="images/pic-1.png" alt="">     
                </div>
            
            </div>
            <div class="sub-rev swiper-slide">
                <div class="qoute"><i class="fa-solid fa-quote-left"></i></div>
                <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, voluptates.</p>
                <div class="wrap-rev">
                    <div class="sub-wrap">
                        <div class="name">nak ptm</div>
                        <span>Fullstack | Developer</span>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <img src="images/pic-2.png" alt="">     
                </div>
            
            </div>
            <div class="sub-rev swiper-slide">
                <div class="qoute"><i class="fa-solid fa-quote-left"></i></div>
                <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, voluptates.</p>
                <div class="wrap-rev">
                    <div class="sub-wrap">
                        <div class="name">nak ptm</div>
                        <span>Fullstack | Developer</span>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <img src="images/pic-3.png" alt="">     
                </div>
            
            </div>
            <div class="sub-rev swiper-slide">
                <div class="qoute"><i class="fa-solid fa-quote-left"></i></div>
                <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, voluptates.</p>
                <div class="wrap-rev">
                    <div class="sub-wrap">
                        <div class="name">nak ptm</div>
                        <span>Fullstack | Developer</span>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <img src="images/pic-4.png" alt="">     
                </div>
            
            </div>
            <div class="sub-rev swiper-slide">
                <div class="qoute"><i class="fa-solid fa-quote-left"></i></div>
                <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, voluptates.</p>
                <div class="wrap-rev">
                    <div class="sub-wrap">
                        <div class="name">nak ptm</div>
                        <span>Fullstack | Developer</span>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <img src="images/pic-5.png" alt="">     
                </div>
            
            </div>
            <div class="sub-rev swiper-slide">
                <div class="qoute"><i class="fa-solid fa-quote-left"></i></div>
                <p class="description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae, voluptates.</p>
                <div class="wrap-rev">
                    <div class="sub-wrap">
                        <div class="name">nak ptm</div>
                        <span>Fullstack | Developer</span>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star-half-stroke"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                    </div>
                    <img src="images/pic-6.png" alt="">     
                </div>
            
            </div>
                  
        </div>
        <div class="swiper-pagination"></div>
    </section>

    <?php include 'components/user_footer.php' ?>
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

        });

    </script>
</body>
</html>