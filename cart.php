<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $user_id = '';
        header('location:user_login.php');
    }
    include 'components/user_header.php';
    require_once 'packages/database.php';
    $data = new Database();
    $fetch_cart = $data->displayCarts($user_id);
    $cartExist = $data->checkExistingCarts($user_id);

?>

    <h2 class="heading-quick mt-5">shopping cart</div>
    <section class="row container mx-auto mb-3 mt-3 text-start" id="carts-view" style="font-size: 1.1rem; font-weight: normal; text-transform: none;">
    <div class="d-flex align-items-center mt-5 pl-4">
            <strong id="loading-message">Loading...</strong>
        </div>
    </section>
    

    <section class="more-shop">
    <?php 
        $total = 0;
        $sub_total = 0;

        foreach ($fetch_cart as $row) {
            $sub_total = $row['price']*$row['quantity'];
            $total += $sub_total;
        }
        ?>

        <!-- <p class="total">grand total : <span>$<?= number_format($total,2); ?>/-</span></p> -->
        <a href="shop.php" class="btn btn-warning">Countinue Chopping</a>
        <button class="btn btn-danger <?= ($cartExist > 0)?'':'disabled'; ?> " id="removeAllItemCarts" type="submit" >Delete All Item</button>
        <a href="proceed.php" class="btn btn-outline-info <?= ($total > 1)?'':'disabled'; ?>" onclick="return(confirm('Checkout now!'))">Proceed To Checkout</a>
    </section>
    <?php include 'components/user_footer.php' ?>
<script type="text/javascript">
    $(document).ready(function(){
    $(window).on('beforeunload',function(){
        $('#loading-message').show();
    });
    
    $(document).on('change', '#update_tocart_form', function(e){
        e.preventDefault();
        $.ajax({
            url: "packages/process.php",
            method: "post",
            data: $(this).serialize()+"&update=update_cart_confirm",
            cache: false,
            success: function(res){
                displayAllCart();
            }
        })

           
        
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
    
    displayAllCart();
    function displayAllCart(){
         $.ajax({
            url: 'packages/process.php',
            method: 'post',
            data: "displayallcarts",
            success: function(res){
                $('#carts-view').html(res);
            }
        })
    }

    $(document).on('click','.removeItemCart',function(e){
        e.preventDefault();
        get_item_cart_id = $(this).attr('id');
            $.ajax({
            url: 'packages/process.php',
            method: 'post',
            data: {get_item_cart_id:get_item_cart_id},
            success: function(res){
                displayAllCountCart();
                displayAllCart();
            }
        })            
    });

    $(document).on('click','#removeAllItemCarts',function(e){
        e.preventDefault();
        alertify.confirm('Are you sure to delete this item.').set('onok', function(closeEvent){ 
            $.ajax({
            url: 'packages/process.php',
            method: 'post',
            data: 'removeAllFromCarts',
            success: function(res){
                displayAllCountCart();
                displayAllCart();
            }
        })            
        } );
    });

    // custom qty click 
    $(document).on('click','.increment-btn',function(e){
                e.preventDefault();
                var qty = $(this).closest('#main-cart').find('.input-qty').val();
                var value = parseInt(qty,10);
                value = isNaN(value)? 0 : value;
                if(value < 10){
                    value++;
                    $(this).closest('#main-cart').find('.input-qty').val(value);
                    
                }
    });
    $('.decrement-btn').click(function(e){
        e.preventDefault();
        var qty = $(this).closest('#main-cart').find('.input-qty').val();
        var value = parseInt(qty,10);
        value = isNaN(value)? 0 : value;
        if(value > 1){
            value--;
            $(this).closest('#main-cart').find('.input-qty').val(value);
            
        }
    });


// end script 
});
</script>
       
  