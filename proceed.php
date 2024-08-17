<?php 
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}
require_once 'packages/database.php';
$data = new Database();
$checkoutExists = $data->checkExistingCarts($user_id);
$fetch_carts= $data->selectCheckoutCart($user_id);


include 'components/user_header.php' 
?>
    
    
    <section class="checkout mt-5">
        <form action="" method="post" id="place-order-form" novalidate class="row needs-validation">
            <div class="col-md-7">
                <h5 class="cart-header">Place order</h5>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="name" class="fw-bolder">Name</label>
                            <input type="text" class="box" name="name" id="name" placeholder="Enter your name" required>
                            <div class="invalid-feedback">name fields is required!</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="email" class="fw-bolder">E-Mail</label>
                            <input type="email" class="box" name="email" id="email" placeholder="Enter your email" required>
                            <div class="invalid-feedback">email fields is required!</div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="number" class="fw-bolder">Phone</label>
                            <input type="text" class="box" name="number" id="number" placeholder="Enter your phone" required>
                            <div class="invalid-feedback">phone fields is required!</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="flat" class="fw-bolder">Address line 01</label>
                            <input type="text" class="box" name="flat" id="flat" placeholder="e.g. flat number" required>
                            <div class="invalid-feedback">address line 1 fields is required!</div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="city" class="fw-bolder">City</label>
                            <input type="text" class="box" name="city" id="city" placeholder="e.g. Phnom Penh" required>
                            <div class="invalid-feedback">city fields is required!</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="street" class="fw-bolder">Address line 02</label>
                            <input type="text" class="box" name="street" id="street" placeholder="e.g. street name" required>
                            <div class="invalid-feedback">address line 2 fields is required!</div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="method" class="fw-bolder">method</label>
                            <select class="box" name="method" id="method" required>
                                <option value="" selected  disabled>--SELECT--</option>
                                <option value="aba">ABA</option>
                                <option value="credit cart">Credit Cart</option>
                                <option value="paypal">PayPal</option>
                                <option value="aceleda">ACELEDA</option>
                                <option value="bitcoin">Bitcoin</option>
                            </select>
                            <div class="invalid-feedback">Please choose one option!</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="country" class="fw-bolder">Country</label>
                            <input type="text" class="box" name="country" id="country" placeholder="e.g. Cambodia" required>
                            <div class="invalid-feedback">country fields is required!</div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="state" class="fw-bolder">State</label>
                            <input type="text" class="box" name="state" id="state" placeholder="e.g. Sensok city" required>
                            <div class="invalid-feedback">state fields is required!</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex flex-column">
                            <label for="pincode" class="fw-bolder">Pin Code</label>
                            <input type="text" class="box" name="pincode" id="pincode" placeholder="e.g. 123654" required>
                            <div class="invalid-feedback">pincode fields is required!</div>
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="col-md-5">
                <h5 class="cart-header">Order Details</h5>
                <hr>
                <?php
                 $total = 0;
                 $sub_total = 0;
                 if($checkoutExists > 0){
                    foreach($fetch_carts as $row){
                        $sub_total = $row['price']*$row['quantity'];
                        $total += $sub_total;
                        $cart_items[] = $row['name'].'('.$row['quantity'].')';
                        $total_product = implode('-',$cart_items);
                        ?>
                        <input type="hidden" name="total_product" id="total_product" value="<?= $total_product; ?>">
                        <input type="hidden" name="total_price" id="total_price" value="<?= $total; ?>">
                        <div class="row shadow-sm align-items-center">
                        <div class="col-md-2 p-2"><img src="image_uploaded/<?= $row['image']; ?>" alt="" width="50" height="50"></div>
                        <div class="col-md-3"><?= $row['name']; ?></div>
                        <div class="col-md-4 text-danger">$<?= $row['price']; ?> /-</div>
                        <div class="col-md-3">x <span class="text-danger"><?= $row['quantity']; ?></span></div>
                        </div>
                        <?php
                    }
                }else{
                    echo '<h4 class="text-center text-shadow py-3">No carts added!</h4>';
                }
                ?>
               
                <hr>
                <div class="d-flex row">
                    <h5 class="col-8 mt-2 text-secondary">Total Price : </h5>
                    <h5 class="col-4 fw-bolder">$/- <span class="text-danger"><?= number_format($total,2); ?></span></h5>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-lg w-100 <?= ($total > 1)?'':'disabled'; ?>" id="lastCheckoutBtn">Confirm to order|CODE</button>
                        <span class="d-flex justify-content-center" >
                            <button class="btn btn-primary loadering" disabled style="display: none;">
                                <span class="spinner-border spinner-border-sm"></span>
                                Loading..
                            </button>
                        </span>
                    </div>
                </div>

            </div>
        </form>
    </section>

    <?php include 'components/user_footer.php' ?>

<script type="text/javascript">
(() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
})()

    $(document).ready(function(){
        
        $(document).on('submit','#place-order-form',function(e){
                e.preventDefault();
                $.ajax({
                    url: "packages/process.php",
                    method: "post",
                    data: $(this).serialize()+"&checkout=confirm_checkouts",
                    beforeSend: function(){
                        $(".loadering").show();
                        $('#lastCheckoutBtn').hide();
                    },
                    success: function(res){
                        if(res === 'succeed'){
                            $(".loadering").hide();
                            $('#lastCheckoutBtn').show();
                            Swal.fire({
                                icon: 'success',
                                title: 'Check with order',
                                text: 'Your order successfully',
                                timer: false,
                                allowOutsideClick: false,
                            });
                            $('#place-order-form')[0].reset();
                            displayAllCountCart();
                                var seconds = 5; // Set the time delay in seconds
                                setTimeout(function() {
                                    location.reload();
                                }, seconds * 1000);
                        }else if(res === 'errored'){
                            $(".loadering").hide();
                            $('#lastCheckoutBtn').show();
                            alertify.warning('Thank You!').dismissOthers();
                        }
                        console.log(res);
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
        

    });
</script>