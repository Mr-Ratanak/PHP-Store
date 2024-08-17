<?php include 'components/user_header.php' ?>
    
    
    <div class="user-search">
        <form action="" method="post" class="search-box" id="search-form">
            <input type="search" class="box" name="searchBox" id="searchBox" placeholder="Search here..." required>
            <button type="submit" id="btnSearch" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>    
    <section>
        <div class="product-search"></div>
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

        $(document).on('submit','#search-form',function(e){
            e.preventDefault();
            $.ajax({
                url: 'packages/process.php',
                method: 'post',
                data: $(this).serialize()+"&search=confirm_box",
                success: function(res){
                    $('.product-search').html(res);
                    console.log(res);
                }
            })
        });


    // end script 
    });
</script>