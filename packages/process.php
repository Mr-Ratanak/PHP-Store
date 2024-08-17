<?php
    require_once 'database.php';
    $utilize = new Database();

    if(isset($_POST['fetch_products'])){
        $output = '';
        $data = $utilize->select_product();
        if($data > 0){
            foreach($data as $row){
                $output.='
                <form action="" method="post" enctype="multipart/form-data" id="add_tocart_form" class="swiper-slide pro-box ">
                <input type="hidden" name="pid" id="pid" value="'.$row['id'].'"> 
                <input type="hidden" name="image" id="image" value="'.$row['image_01'].'"> 
                <input type="hidden" name="name" id="name" value="'.$row['name'].'"> 
                <input type="hidden" name="price" id="price" value="'.$row['price'].'">    
                <img class="image" src="image_uploaded/'.$row['image_01'].'" alt="">
                    <h3 class="title">'.substr($row['name'],0,30).'</h3>
                    <div class="flex">
                        <span class="price">$'.$row['price'].'/-</span>
                        <input class="qty" name="qty" id="qty" type="number" min="1" max="99" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary addToCartBtn" name="add_to_cart">Add To Cart</button>
                    <a class="quick-view" href="quick-view.php?pid='.$row['id'].'"><i class="fas fa-eye"></i></a>
                    <button type="submit" class="heart addToWishlistBtn" name="add_to_wishlist"><i class="fas fa-heart"></i></button>
                </form>
                ';
            }
        }else{
            echo '<h3 class="text-center text-shadow py-3">No Product Found!</h3>';
        }
        echo $output;
        // echo json_encode($data);
    }

    if (isset($_POST['submit_button'])) {
        $pid = $utilize->test_input($_POST['pid']);
        $image = $utilize->test_input($_POST['image']);
        $name = $utilize->test_input($_POST['name']);
        $price = $utilize->test_input($_POST['price']);
        $qty = $utilize->test_input($_POST['qty']);
        $check_wishlist_exist = $utilize->check_wishlist_exist($name,$user_id);
        $check_cart_exist = $utilize->check_cart_exist($name,$user_id);
    if ($_POST['submit_button'] === 'add_to_cart') {
            if($user_id == ''){
                echo 'user_exist';
                }else{
                    if($check_wishlist_exist > 0){
                        echo 'wishlist_exist';
                    }elseif($check_cart_exist > 0){
                        echo 'cart_exist';
                    }else{
                        $utilize->addToCart($user_id,$pid,$name,$price,$qty,$image);
                    }
                    
                }
        } else {
            if($user_id == ''){
                   echo 'user_exist';
                }else{
                    if($check_wishlist_exist > 0){
                    echo 'wishlist_exist';
                    }elseif($check_cart_exist > 0){
                        echo 'cart_exist';
                    }else{
                        $utilize->addToWishlist($user_id,$pid,$name,$price,$image);
                        }
                    }
            }
    }
    
    if (isset($_POST['add_cart']) && $_POST['add_cart'] == 'confirm_cart'){
        $pid = $utilize->test_input($_POST['pid']);
        $image = $utilize->test_input($_POST['image']);
        $name = $utilize->test_input($_POST['name']);
        $price = $utilize->test_input($_POST['price']);
        $qty = $utilize->test_input($_POST['qty']);
        $check_wishlist_exist = $utilize->check_wishlist_exist($name,$user_id);
        $check_cart_exist = $utilize->check_cart_exist($name,$user_id);
        
        if($check_cart_exist > 0){
            echo 'cart_ex';
        }else{
            $utilize->addToCart($user_id,$pid,$name,$price,$qty,$image);
             $utilize->deleteWishlist($name,$user_id);
        }

    }


    if(isset($_POST['displaycarts'])){
        $data = $utilize->countAllCart($user_id);
        echo $data;
    }
    if(isset($_POST['displaywishlists'])){
        $data = $utilize->countAllWishlist($user_id);
        echo $data;
    }

    // register 
    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $name = $utilize->test_input($_POST['name']);
        $email = $utilize->test_input($_POST['email']);
        $password = $utilize->test_input($_POST['password']);
        $cpassword = $utilize->test_input($_POST['cpassword']);
        $hpass = sha1($password);
        $check_user_exist = $utilize->check_user_exists($name,$email);
        if($password!= $cpassword){
            $utilize->showMessage('warning','Confirm password not match');         
        }else{
          if($check_user_exist!= ''){
            $utilize->showMessage('danger','Email already register!'); 
          }else{
            $register = $utilize->user_register($name,$email,$hpass);
            $utilize->showMessage('success','Register successfully');
          }
        }
    }

    // user login
    if(isset($_POST['action']) && $_POST['action'] == 'user-login'){
        $email = $utilize->test_input($_POST['email']);
        $password = $utilize->test_input($_POST['password']);
        $hpassword = sha1($password);
        $login = $utilize->userLogin($email,$hpassword);
        if($login!= null){
            $_SESSION['user_id'] = $login['id'];
            echo 'user_login';
        }else{
            $utilize->showMessage('warning','Incorrect email or password');
        }
    }

    if(isset($_POST['display-user'])){
        $output = '';
        $data = $utilize->profileUser($user_id);
        if($data!= null){
            foreach($data as $row){
            $output.='
            <div class="sub-link">
                <h3>'.$row['name'].'</h3>
                <a href="update-profile.php" class="btn btn-warning sub-bt">Update Profile</a>
                <div class="flex">
                    <a class="btn btn-warning" href="user_register.php">Register</a>
                    <a class="btn btn-warning" href="user_login.php">Login</a>
                </div>
                <a href="packages/user_logout.php" class="btn btn-danger sub-bt Click" onclick="return confirm(\'Are you sure?\');">Logout</a>
            </div>
            ';
            }
        }else{
            $output.='
            <div class="sub-link">
            <p>please login or register first!</p>
                <div class="flex">
                    <a class="btn btn-warning" href="user_register.php">Register</a>
                    <a class="btn btn-warning" href="user_login.php">Login</a>
                </div>
            </div>
            ';
        }   
        echo $output;
    }

    // profile user 
    if(isset($_POST['fetch_profile'])){
        $data = $utilize->profileUser($user_id);
        $output= '';
       if($data){
            foreach($data as $row){
                $output.='
                <form action="#" method="post" id="update-profile-form">
                <h2>update profile</h2>
                <input type="hidden" name="id" id="id" value="'.$row['id'].'">
                <input type="hidden" name="pre_password" id="pre_password" value="'.$row['password'].'">
                <input type="text" class="re-box" name="username" id="username" value="'.$row['name'].'" placeholder="enter your name" required>
                <input type="email" class="re-box" name="email" id="email" value="'.$row['email'].'" placeholder="enter your email" required>
                <div class="invalid-feedback">Email field is required!</div>
                <input type="password" class="re-box" name="old_password" id="old_password" placeholder="enter your old password" >
                <input type="password" class="re-box" name="new_password" id="new_password" placeholder="enter your new password" >
                <div class="invalid-feedback">Password field is required!</div>
                <input type="password" class="re-box" name="c_new_password" id="c_new_password" placeholder="comfirm your new password" >
                <div class="invalid-feedback">Please confirm password!</div>
                <input type="submit" class="btn btn-primary" id="updateProUserBtn" value="Update">
                <span class="d-flex justify-content-center" >
                    <button class="btn btn-primary loadering" disabled style="display: none;">
                        <span class="spinner-border spinner-border-sm"></span>
                        Loading..
                    </button>
                </span>
                <p><a href="javascript=0;" class="">forgot password?</a></p>
                
            </form>
                ';
            }
       }else{
        echo '<h2>Something went wrong!</h2>';
       }
       echo $output;
    }

    if(isset($_POST['action']) && $_POST['action'] == 'update-profile'){
        //  $id = $utilize->test_input($_POST['id']);
         $update_name = $utilize->test_input($_POST['username']);
         $update_email = $utilize->test_input($_POST['email']);

         $pre_password = $utilize->test_input($_POST['pre_password']);
         $empty_password = $pre_password;
         $old_password = $utilize->test_input($_POST['old_password']);
         $hold_password = sha1($old_password);
         $new_password = $utilize->test_input($_POST['new_password']);
         $hnew_password = sha1($new_password);
         $c_new_password = $utilize->test_input($_POST['c_new_password']);
         $hpassword = sha1($c_new_password);
        
         $update = $utilize->updateUserProfile($user_id,$update_name,$update_email);
         if(!$update){
            $utilize->showMessage('warning','update failed');             
         }

        if($hold_password != $empty_password){
            $utilize->showMessage('warning','please enter old password!');
        }elseif($hold_password != $pre_password){
            $utilize->showMessage('warning','Old password not match!');
        }elseif($hnew_password != $hpassword){
            $utilize->showMessage('warning','Confirm password not match!');
         }else{
            if($hnew_password != $empty_password){
                $utilize->updateProfilePassword($hpassword,$user_id);
                $utilize->showMessage('success','Password has been updated!');
            }else{
                $utilize->showMessage('warning','Please enter new password!');
            }
         }
    }
    
//    contact control 
    if(isset($_POST['contact']) && $_POST['contact'] == 'confirm_contact'){
        $name = $utilize->test_input($_POST['name']);
        $email = $utilize->test_input($_POST['email']);
        $number = $utilize->test_input($_POST['number']);
        $messages = $utilize->test_input($_POST['messages']);
        $checkExistsMessage = $utilize->check_messageExists($name,$email,$number,$messages);
        if($checkExistsMessage > 0){
            echo 'msg_exist';
        }else{
            $utilize->sendMessage($name,$email,$number,$messages);
            echo 'msg_success';
        }
    }

    // search control 
    if(isset($_POST['search']) && $_POST['search'] == 'confirm_box'){
        $search_box = $utilize->test_input($_POST['searchBox']);
        $searchExisting = $utilize->searchExisting();
        $data = $utilize->searchAllEngine($search_box);

        $output='';
        if($searchExisting > 0){
            $output.='<section class="main-shop">';
            foreach($data as $row){
                $output.='
                
                <form action="" method="post" id="add_tocart_form" class="sub-shop">
                <input type="hidden" name="pid" id="pid" value="'.$row['id'].'"> 
                <input type="hidden" name="image" id="image" value="'.$row['image_01'].'"> 
                <input type="hidden" name="name" id="name" value="'.$row['name'].'"> 
                <input type="hidden" name="price" id="price" value="'.$row['price'].'">    

                <img class="image" src="image_uploaded/'.$row['image_01'].'" alt="">
                    <h3 class="title">'.$row['name'].'</h3>
                    <div class="flex">
                        <span class="price">$'.number_format($row['price'],2).'/-</span>
                        <input class="qty" name="qty" id="qty" type="number" min="1" max="99" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary addToCartBtn" name="add_to_cart">Add To Cart</button>
                    <a class="quick-view" href="quick-view.php?pid='.$row['id'].'"><i class="fas fa-eye"></i></a>
                    <button type="submit" class="heart addToWishlistBtn" name="add_to_wishlist"><i class="fas fa-heart"></i></button>
                </form>
                ';
            }
            $output.='</section>';
        }else{
            $output.='
            echo "<h3 class="text-center text-shadow">No products found!</h3>";
            ';
        }
        echo $output;
    }

    // wishlist 
    if(isset($_POST['displaywishlist'])){
        $output = '';
        $data = $utilize->displayWishlist($user_id);
        $checkExisting = $utilize->checkExistingWishlist($user_id);
        if($checkExisting > 0){
            foreach($data as $row){
                $output.='<div class="main-category">';
                $output.='
                <form action="" method="post" id="add_tocart_form" class="sub-category">
                <input type="hidden" name="pid" id="pid" value="'.$row['pid'].'"> 
                <input type="hidden" name="image" id="image" value="'.$row['image'].'"> 
                <input type="hidden" name="name" id="name" value="'.$row['name'].'"> 
                <input type="hidden" name="price" id="price" value="'.$row['price'].'">   
                <a href="quick-view.php?pid='.$row['pid'].'">
                <img class="image" src="image_uploaded/'.$row['image'].'" alt="">
                </a> 
                    <h3 class="title">'.$row['name'].'</h3>
                    <div class="flex">
                        <span class="price">$'.$row['price'].'/-</span>
                        <input class="qty" name="qty" id="qty" type="number" min="1" max="99" value="1">
                    </div>
                <div class="d-flex justify-content-between py-0">
                <button type="submit" class="btn btn-primary addToCartBtn fs-6" name="add_to_cart"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                <button type="submit" id="'.$row['id'].'" class="btn btn-danger delWishlistBtn fs-6"><i class="fas fa-trash-alt"></i> Delete wishlist</button>
                </div>
                <a class="quick-view" href="quick-view.php?pid='.$row['pid'].'"><i class="fas fa-eye"></i></a>
                </form>
                ';
                $output.='</div>';
            }
        }else{
            echo '<h3 class="text-center text-shadow py-3">No Wishlist Found!</h3>';
        }
        echo $output;
    }

    if(isset($_POST['get_wishlist_id'])){
        $id = $utilize->test_input($_POST['get_wishlist_id']);
        $data = $utilize->removeWish($id);
    }
    if(isset($_POST['delAllFromWishlist'])){
        $data = $utilize->removeAllWish($user_id);
    }

    // cart control 
    if(isset($_POST['displayallcarts'])){
        $data = $utilize->displayCarts($user_id);
        $output = '';
        $data = $utilize->displayCarts($user_id);
        $checkExisting = $utilize->checkExistingCarts($user_id);
        $sub_total = 0;
        if($checkExisting > 0){
            $output.='
            <div class="col-md-2" >Product</div>
            <div class="col-md-2"></div>        
            <div class="col-md-1">Price</div>
            <div class="col-md-2">Sub Total</div>
            <div class="col-md-3">Quantity</div>
            <div class="col-md-2">Remove</div>
            <hr>';
            foreach($data as $row){
                $sub_total = number_format($row['price']*$row['quantity'],2);
                $output.='
                <div class="row bg-white rounded-1 py-1 shadow-sm align-items-center mb-2" >
                    <div class="col-md-2"><img src="image_uploaded/'.$row['image'].'" width="50" height="50" alt=""></div>
                    <h6 class="col-md-2">'.$row['name'].'</h6>
                    <div class="col-md-1">$'.$row['price'].'/-</div>
                    <div class="col-md-2">$'.$sub_total.'/-</div>
                    <div class="col-md-3" >
                        <form action="" method="post" id="update_tocart_form" class="input-group" style="width: 130px;">
                        <input type="hidden" name="id" id="id" value="'.$row['id'].'"> 
                            <input type="button" class="input-group-text text-center decrement-btn" value="-">
                            <input type="number" class="text-center form-control input-qty bg-white" value="'.$row['quantity'].'" name="qty" id="qty" value="1" min="0" max="10" title="qty">
                            <input type="button" class="input-group-text text-center increment-btn" value="+">
                        </form>
                    </div>
                    <div class="col-md-2"><button type="submit" id="'.$row['id'].'" class="btn btn-outline-danger p-1 rounded-1 removeItemCart" ><i class="fas fa-trash-alt"></i> Remove</button></div>
                </div>
                ';
            }
        }else{
            echo '<h3 class="text-center text-shadow py-3">No Products Found!</h3>';
        }
        echo $output;
    }

    if(isset($_POST['update']) && $_POST['update'] == 'update_cart_confirm'){
        $qty = $utilize->test_input($_POST['qty']);
        $cart_id = $utilize->test_input($_POST['id']);
        $data = $utilize->updateCartQty($qty,$cart_id);
    }
    if(isset($_POST['get_item_cart_id'])){
        $get_item_id = $utilize->test_input($_POST['get_item_cart_id']);
        $data = $utilize->removeItemCart($get_item_id);
    }
    if(isset($_POST['removeAllFromCarts'])){
        $data = $utilize->removeAllItemCarts($user_id);
    }

    // checkout control 
    if(isset($_POST['checkout']) && $_POST['checkout'] == 'confirm_checkouts'){
        $name = $utilize->test_input($_POST['name']);
        $email = $utilize->test_input($_POST['email']);
        $number = $utilize->test_input($_POST['number']);
        $address = $utilize->test_input($_POST['flat'].', '. $_POST['city'].', '. $_POST['street'].', '. $_POST['country']
        .', '. $_POST['state'].', '. $_POST['pincode']);
        $method = $utilize->test_input($_POST['method']);
        $total_product = $utilize->test_input($_POST['total_product']);
        $total_price = $utilize->test_input($_POST['total_price']);
        $check = $utilize->checkExistingOrders($user_id,$name,$number,$email);
        
        if($check > 0){
            echo 'errored';
        }else{
            $data = $utilize->checkoutProceed($user_id,$name,$number,$email,$method,$address,$total_product,$total_price);
            $utilize->removeAllItemCarts($user_id);
            echo 'succeed';
        }
    }
    // order control 
    if(isset($_POST['get_orderId'])){
        $order_id = $utilize->test_input($_POST['get_orderId']);
        $data = $utilize->getIDOrders($order_id);
        $checkOrder = $utilize->countProOrders($user_id);
        if($checkOrder > 0){
        $output='';
        foreach($data as $row){
            $output.='
            <div class="col-7" style="border-right: 1px solid gray;"> 
                <div class="product">
                    <p class="box">placed on : <span class="text-primary">'.$row['placed_on'].'</span></p>
                    <p class="box">name : <span class="text-primary">'.$row['name'].'</span></p>
                    <p class="box">email : <span class="text-primary">'.$row['email'].'</span></p>
                    <p class="box">number : <span class="text-primary">'.$row['number'].'</span></p>
                    <p class="box">address: <span class="text-primary">'.$row['address'].'</span></p>
                    <p class="box">your orders : <span class="text-primary">'.$row['total_products'].'</span></p>
                    <p class="box">total price : <span class="text-primary">$'.number_format($row['total_price'],2).' -</span></p>
                    <p class="box">payment status : <span class="text-primary">'.$row['payment_status'].'</span></p>  
                </div>
            </div>
            ';
            $output.='
                <div class="col-5 align-self-center">
                <hr>
                    <div class="d-flex row">
                        <h5 class="col-8 mt-2 text-secondary">Total Price : </h5>
                        <h5 class="col-4 fw-bolder">$/- <span class="text-danger">'.$row['total_price'].'</span></h5>
                    </div>
                    <hr>
                    <div class="d-flex row">
                        <h5 class="col-8 mt-2 text-secondary">Payment Method : </h5>
                        <h5 class="col-4 fw-bolder mt-2"><span class="text-primary">'.$row['method'].'</span></h5>
                    </div>
                    <p class="text-center text-success pt-3">Thank You!</p>
                </div>
            ';
        }
    }else{
        echo '<h3 class="text-center text-shadow py-3">No Order Found!</h3>';
    }
    echo $output;         
    }


?>