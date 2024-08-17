<?php 
    // session_start();
    // if(isset($_SESSION['user_id'])){
    //     $user_id = $_SESSION['user_id'];
    // }else{
    //     $user_id = '';
    //     header('location:user_login.php');
    // }

    require_once 'packages/database.php';
    $data = new Database();
    $fetch_product = $data->displayProduct();
    $check_productExist = $data->check_ProExist();
    include 'components/user_header.php';
    
?>
    
    
    <h2 class="order-heading mt-5">lastest products</h2>
    <section class="main-shop">
        <?php
        if($check_productExist > 0){
            foreach($fetch_product as $row){
                ?>
                <form action="" method="post" id="add_tocart_form" class="sub-shop">
                <input type="hidden" name="pid" id="pid" value="<?= $row['id']; ?>"> 
                <input type="hidden" name="image" id="image" value="<?= $row['image_01']; ?>"> 
                <input type="hidden" name="name" id="name" value="<?= $row['name']; ?>"> 
                <input type="hidden" name="price" id="price" value="<?= $row['price']; ?>">    

                <a href="quick-view.php?pid=<?= $row['id']; ?>">
                <img class="image" src="image_uploaded/<?= $row['image_01']; ?>" alt="">
                </a>
                    <h3 class="title"><?= $row['name']; ?></h3>
                    <div class="flex">
                        <span class="price">$<?= number_format($row['price'],2); ?>/-</span>
                        <input class="qty" name="qty" id="qty" type="number" min="1" max="99" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary addToCartBtn rounded-5" name="add_to_cart"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                    <a class="quick-view" href="quick-view.php?pid=<?= $row['id']; ?>"><i class="fas fa-eye"></i></a>
                    <button type="submit" class="heart addToWishlistBtn" name="add_to_wishlist"><i class="fas fa-heart"></i></button>
                </form>
                <?php
            }
        }else{
            echo '<h3 class="text-center text-shadow">No products found!</h3>';
        }
        ?> 

    </section>

<?php include 'components/user_footer.php' ?>

<script type="text/javascript">
$(document).ready(function(){
    
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


// end script 
});
</script>