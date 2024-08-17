<?php 
session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
        header('location:user_login.php');
    }
    include 'components/user_header.php';
    include 'packages/database.php';
    $data = new Database();
    $fetch_wishlist = $data->displayWishlist($user_id);
    $wishlistExisting = $data->checkExistingWishlist($user_id);

?>
    
       <h2 class="heading-quick">your wishlist</div>
    <section class="wrap-category" id="wishlistShow">
        
    <?php 
    $grandTotal = 0;
    if($wishlistExisting > 0){
        foreach($fetch_wishlist as $row){
            $grandTotal += $row['price'];
           
        }
    }
    ?>
       
    </section>
    <section class="more-shop">
        <p class="total">grand total : <span>$<?= $grandTotal; ?>/-</span></p>
        <a href="shop.php" class="btn btn-warning ">Countinue Chopping</a>
        <button class="btn btn-outline-danger <?= ($grandTotal > 1)?'':'disabled'; ?>" id="delAllWishlistBtn" type="submit"><i class="fas fa-trash-alt"></i> Delete All Item</button>
    </section>

    <?php include 'components/user_footer.php' ?>

    <script type="text/javascript">
    $(document).ready(function(){
    
    $(document).on('submit', '#add_tocart_form', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
                $.ajax({
                    url: "packages/process.php",
                    method: "post",
                    data: formData + "&add_cart=confirm_cart",
                    success: function(res) {
                        if(res === 'user_exist'){
                            window.location= 'user_login.php';
                        }else{
                            if(res === 'cart_ex'){
                                alertify.warning('Product already to cart').dismissOthers();
                            }else{
                                alertify.success('Product added to successful!').dismissOthers();
                                displayAllCounWishlist();
                                displayAllCountCart();
                                displayAllWishlist();
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
    
    displayAllWishlist();
    function displayAllWishlist(){
         $.ajax({
            url: 'packages/process.php',
            method: 'post',
            data: "displaywishlist",
            success: function(res){
                $('#wishlistShow').html(res);
            }
        })
    }

    $(document).on('click','.delWishlistBtn',function(e){
        e.preventDefault();
        get_wishlist_id = $(this).attr('id');

        alertify.confirm('Are you sure to delete this item.').set('onok', function(closeEvent){ 
            $.ajax({
            url: 'packages/process.php',
            method: 'post',
            data: {get_wishlist_id:get_wishlist_id},
            success: function(res){
                displayAllCounWishlist();
                displayAllWishlist();
            }
        })            
        } );
    });

    $(document).on('click','#delAllWishlistBtn',function(e){
        e.preventDefault();
        alertify.confirm('Are you sure to delete this item.').set('onok', function(closeEvent){ 
            $.ajax({
            url: 'packages/process.php',
            method: 'post',
            data: 'delAllFromWishlist',
            success: function(res){
                displayAllCounWishlist();
                displayAllWishlist();
            }
        })            
        } );
    });


// end script 
});
</script>