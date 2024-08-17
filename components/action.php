<?php
session_start();
    require_once 'config.php';
    $util = new Database();
    // $admin_id = $_SESSION['admin_id'];

    if(isset($_POST['action']) && $_POST['action'] == 'login'){
        $name = $util->test_input($_POST['name']);
        $password = $util->test_input($_POST['password']);
        $hpass = sha1($password);

        $select_admin_id = $util->admin_login($name,$hpass);
        if($select_admin_id!= null){
            $_SESSION['admin_id'] = $select_admin_id['id'];
            echo 'login';
        }else{
            $util->showMessage('warning','Incorrect password or username!');
        }
    }
    
    // register admin \
    if(isset($_POST['action']) && $_POST['action'] == 'admin-register'){
        $name = $util->test_input($_POST['name']);
        $password = $util->test_input($_POST['password']);
        $cpassword = $util->test_input($_POST['cpassword']);
        $hpassword = sha1($password);

        $admin_exist = $util->admin_login($name,$hpassword);
        if($admin_exist!= null){
            $util->showMessage('warning','Username already exists!');
        }else{
            if($password!= $cpassword){
                $util->showMessage('danger','password did not match!');
            }else{
                $util->registerAdmin($name,$hpassword);
                $util->showMessage('success','Register successfully');
            }
        }
    }
    // update admin profile 
    if(isset($_POST['action']) && $_POST['action'] == 'update_admin_profile'){
        $admin_id = $util->test_input($_POST['admin_id']);
        $name = $util->test_input($_POST['name']);
        // $empty_pass = '40bd001563085fc35165329ea1ff5c5ecbdbbeef';
        $prev_pass = $util->test_input($_POST['prev_pass']);
        $empty_pass = $prev_pass;
        $old_pass = $util->test_input($_POST['old_pass']);
        $cv_old_pass = sha1($old_pass);
        $new_pass = $util->test_input($_POST['npass']);
        $cv_new_pass = sha1($new_pass);
        $con_pass = $util->test_input($_POST['cpass']);
        $hnew_pass = sha1($con_pass);
        $update_admin_name = $util->updateAdminName($name,$admin_id);

        // if($old_pass == $prev_pass){
        //     $util->showMessage('warning','Please enter old password!');
        // }elseif($old_pass == $new_pass){
        //     $util->showMessage('warning','Old password not match!');
        // }elseif($new_pass != $con_pass){
        //     $util->showMessage('warning','Confirm password not match!');
        // }else{
        //     if($new_pass != $prev_pass){
        //         $util->updateAdminProfile($hnew_pass,$admin_id);
        //         $util->showMessage('success','Update admin successfully!');
        //     }else{
        //         $util->showMessage('warning','please enter new password');
        //     }
        // }
       
           if($cv_old_pass != $empty_pass){
            $util->showMessage('warning','Please enter old password!');
        }elseif($cv_old_pass != $prev_pass){
            $util->showMessage('warning','Old password not match!');
        }elseif($cv_new_pass != $hnew_pass){
            $util->showMessage('warning','Confirm password not match!');
        }else{
            if($cv_new_pass != $empty_pass){
                $util->updateAdminProfile($hnew_pass,$admin_id);
                $util->showMessage('success','Update admin successfully!');
            }else{
                $util->showMessage('warning','please enter new password');
            }
        }
    }

    // add product 
    if(isset($_POST['add-product'])){
        $product_name = $util->test_input($_POST['product_name']);
        $category_id = $util->test_input($_POST['category_id']);
        $product_detail = $util->test_input($_POST['product_detail']);
        $product_price = $util->test_input($_POST['product_price']);
        $product_exists = $util->select_product_name($product_name);

        $image_name_01 = $_FILES['product_01']['name'];
        $image_size_01 = $_FILES['product_01']['size'];
        $image_tmp_01 = $_FILES['product_01']['tmp_name'];

        $image_name_02 = $_FILES['product_02']['name'];
        $image_size_02 = $_FILES['product_02']['size'];
        $image_tmp_02 = $_FILES['product_02']['tmp_name'];

        $image_name_03 = $_FILES['product_03']['name'];
        $image_size_03 = $_FILES['product_03']['size'];
        $image_tmp_03 = $_FILES['product_03']['tmp_name'];

        $target_dir_01 = '../image_uploaded/';
        $image_ext_01 = pathinfo($image_name_01,PATHINFO_EXTENSION);
        $image_unique_name_01 = uniqid().'.'.$image_ext_01;
        $image_path_01 = $target_dir_01. $image_unique_name_01;

        $target_dir_02 = '../image_uploaded/';
        $image_ext_02 = pathinfo($image_name_02,PATHINFO_EXTENSION);
        $image_unique_name_02 = uniqid().'.'.$image_ext_02;
        $image_path_02 = $target_dir_02. $image_unique_name_02;

        $target_dir_03 = '../image_uploaded/';
        $image_ext_03 = pathinfo($image_name_03,PATHINFO_EXTENSION);
        $image_unique_name_03 = uniqid().'.'.$image_ext_03;
        $image_path_03 = $target_dir_03. $image_unique_name_03;

        if($image_ext_01!= 'jpg' && $image_ext_01!= 'jpeg' && $image_ext_01!= 'png' && $image_ext_01!= 'webp' && $image_ext_01!= 'jfif' OR 
        $image_ext_02!= 'jpg' && $image_ext_02!= 'jpeg' && $image_ext_02!= 'png' && $image_ext_02!= 'webp' && $image_ext_02!= 'jfif' OR 
        $image_ext_03!= 'jpg' && $image_ext_03!= 'jpeg' && $image_ext_03!= 'png' && $image_ext_03!= 'webp' && $image_ext_03!= 'jfif'){
            $util->showMessage('warning','Image extension not match!');
        }elseif($product_exists){
            $util->showMessage('warning','Product name already uploaded!');
        }elseif($image_size_01 >= 1000*1000*2.5 OR $image_size_02 >= 1000*1000*2.5 OR $image_size_03 >= 1000*1000*2.5){
            $util->showMessage('warning','Image size is too large!');
        }else{
            move_uploaded_file($image_tmp_01,$image_path_01);
            move_uploaded_file($image_tmp_02,$image_path_02);
            move_uploaded_file($image_tmp_03,$image_path_03);
            $util->uploadProduct($product_name,$category_id,$product_detail,$product_price,$image_unique_name_01,$image_unique_name_02,$image_unique_name_03);
            $util->showMessage('success','Product uploaded successfully!');
        }

    }

    // display product
    if(isset($_POST['fetch_product'])){
            $output = '';
            $data = $util->fetchProduct();
            $output.='
            <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Image1</th>
                <th>Image2</th>
                <th>Image3</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price</th>
                <th>Detail</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            ';
            if($data > 0){
                foreach ($data as $row){
                    $output.='
                    <tr class="align-middle text-center">
                    <td>'.$row['id'].'</td>
                    <td><img src="../image_uploaded/'.$row['image_01'].'" alt="" width="50" height="50"></td>
                    <td><img src="../image_uploaded/'.$row['image_02'].'" alt="" width="50" height="50"></td>
                    <td><img src="../image_uploaded/'.$row['image_03'].'" alt="" width="50" height="50"></td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['category_name'].'</td>
                    <td>$'.$row['price'].'-/</td>
                    <td>'.substr($row['details'],0,15).'...</td>
                    <td class="iconPro">
                        <button type="submit" id="'.$row['id'].'" class="text-success bg-white btnIconEditPro" data-bs-toggle="modal" data-bs-target="#editProductModal"><i class="fas fa-edit"></i></button>
                        <button class="text-warning bg-white btnIconDelPro" id="'.$row['id'].'" ><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                    ';
                }
               
            }else{
                echo '<div class="col-md-12"><h3 class="text-center">No products found!</h3></div>';
            }
        $output.='</tbody>';
        echo $output;
    }
    if(isset($_POST['get_del_id'])){
        $del_id = $_POST['get_del_id'];
        $data = $util->delProduct($del_id);

        if($data){
            $util->delProductCart($del_id);
            $util->delProductWishlist($del_id);
            $status = array(
                'status'=>'success',
            );
        }else{
            $status = array(
                'status'=>'error',
            );
        }
    }

    if(isset($_POST['get_pro_id'])){
        $id = $util->test_input($_POST['get_pro_id']);
        $data = $util->editProduct($id);
        echo json_encode($data);
    }
    if(isset($_POST['update_product_confirm'])){
        $edit_image_id = $util->test_input($_POST['edit_image_id']);
        $edit_product_name = $util->test_input($_POST['edit-name']);
        $edit_category_id = $util->test_input($_POST['edit_category_id']);
        $edit_product_detail = $util->test_input($_POST['edit-detail']);
        $edit_product_price = $util->test_input($_POST['edit-price']);
        $old_image_01 = $util->test_input($_POST['old_image_01']);
        $old_image_02 = $util->test_input($_POST['old_image_02']);
        $old_image_03 = $util->test_input($_POST['old_image_03']);

        $image_name_01 = $_FILES['edit_image_01']['name'];
        $image_size_01 = $_FILES['edit_image_01']['size'];
        $image_tmp_01 = $_FILES['edit_image_01']['tmp_name'];

        $image_name_02 = $_FILES['edit_image_02']['name'];
        $image_size_02 = $_FILES['edit_image_02']['size'];
        $image_tmp_02 = $_FILES['edit_image_02']['tmp_name'];

        $image_name_03 = $_FILES['edit_image_03']['name'];
        $image_size_03 = $_FILES['edit_image_03']['size'];
        $image_tmp_03 = $_FILES['edit_image_03']['tmp_name'];

        $target_dir_01 = '../image_uploaded/';
        $image_ext_01 = pathinfo($image_name_01,PATHINFO_EXTENSION);
        $image_unique_name_01 = uniqid().'.'.$image_ext_01;
        $image_path_01 = $target_dir_01. $image_unique_name_01;

        $target_dir_02 = '../image_uploaded/';
        $image_ext_02 = pathinfo($image_name_02,PATHINFO_EXTENSION);
        $image_unique_name_02 = uniqid().'.'.$image_ext_02;
        $image_path_02 = $target_dir_02. $image_unique_name_02;

        $target_dir_03 = '../image_uploaded/';
        $image_ext_03 = pathinfo($image_name_03,PATHINFO_EXTENSION);
        $image_unique_name_03 = uniqid().'.'.$image_ext_03;
        $image_path_03 = $target_dir_03. $image_unique_name_03;

        $util->updateProduct($edit_image_id,$edit_product_name,$edit_category_id,$edit_product_detail,$edit_product_price);
        $util->showMessage('success','Product updated successfully!');

        if($image_ext_01!= 'jpg' && $image_ext_01!= 'jpeg' && $image_ext_01!= 'png' && $image_ext_01!= 'webp' && $image_ext_01!= 'jfif'){
            $util->showMessage('warning','Image extension not match!');
        }elseif($image_size_01 >= 1000*1000*2.5){
            $util->showMessage('warning','Image size is too large!');
        }else{
            if(isset($image_name_01) && $image_name_01!= ''){
                $new_image_path_01 = $image_name_01;
                move_uploaded_file($image_tmp_01,$image_path_01);    
                if($old_image_01!= null){
                    unlink('../image_uploaded/'.$old_image_01);
                }
               $util->updateProductImage01($edit_image_id,$image_unique_name_01);
                $util->showMessage('success','Product image 01 updated!');
            }else{
                $new_image_path_01 = $old_image_01;
            }
        }

            if($image_ext_02!= 'jpg' && $image_ext_02!= 'jpeg' && $image_ext_02!= 'png' && $image_ext_02!= 'webp' && $image_ext_02!= 'jfif'){
                $util->showMessage('warning','Image extension not match!');
            }elseif($image_size_02 >= 1000*1000*2.5){
                $util->showMessage('warning','Image size is too large!');
            }else{
                if(isset($image_name_02) && $image_name_02!= ''){
                    $new_image_path_02 = $image_name_02;
                    move_uploaded_file($image_tmp_02,$image_path_02);    
                    if($old_image_02!= null){
                        unlink('../image_uploaded/'.$old_image_02);
                    }
                    $util->updateProductImage02($edit_image_id,$image_unique_name_02);
                    $util->showMessage('success','Product image 02 updated!');
                }else{
                    $new_image_path_02 = $old_image_02;
                }

                if($image_ext_03!= 'jpg' && $image_ext_03!= 'jpeg' && $image_ext_03!= 'png' && $image_ext_03!= 'webp' && $image_ext_03!= 'jfif'){
                    $util->showMessage('warning','Image extension not match!');
                }elseif($image_size_02 >= 1000*1000*2.5){
                    $util->showMessage('warning','Image size is too large!');
                }else{
                    if(isset($image_name_03) && $image_name_03!= ''){
                        $new_image_path_03 = $image_name_03;
                        move_uploaded_file($image_tmp_03,$image_path_03);    
                        if($old_image_03!= null){
                            unlink('../image_uploaded/'.$old_image_03);
                        }
                       $util->updateProductImage03($edit_image_id,$image_unique_name_03);
                        $util->showMessage('success','Product image 03 updated!');
                    }else{
                        $new_image_path_03 = $old_image_03;
                    }
                }      
           
        }
    }

    if(isset($_POST['confirm_all_product'])){
        $util->deleteAllProduct();
    }

    // if(isset($_POST['select_category'])){
    //     $data = $util->selectCategory();
    //     echo json_encode($data);
    // }

    // product order 
    if(isset($_POST['display_order'])){
        $output = '';
        $data = $util->displayOrder();
        $check_order_exist = $util->checkOrderExists();
        if($check_order_exist > 0 ){
            foreach($data as $row){
                $output.='
                <form action="" method="post" class="main-box" id="order-update-form">
                <input type="hidden" name="order_id" id="order_id" value="'.$row['id'].'">
                <p class="box">placed on : <span>'.$row['placed_on'].'</span></p>
                <p class="box">name : <span>'.$row['name'].'</span></p>
                <p class="box">email : <span>'.$row['email'].'</span></p>
                <p class="box">number : <span>'.$row['number'].'</span></p>
                <p class="box">address: <span>'.$row['address'].'</span></p>
                <p class="box">payment method : <span>'.$row['method'].'</span></p>
                <p class="box">your orders : <span>'.$row['total_products'].' -</span></p>
                <p class="box">total price : <span>'.$row['total_price'].'/-</span></p>
                <p class="box">payment status : <span>'.$row['payment_status'].'</span></p>
                <select class="procedure" name="procedure" id="procedure">
                    <option value="" disabled selected>'.$row['payment_status'].'</option>
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                </select>
                <div class="d-flex justify-content-between my-2">
                    <button class="btn btn-warning UpdatePayment" type="submit">update</button>
                    <button id="'.$row['id'].'" class="btn btn-danger DeleteOrder" type="submit">delete</button>
                </div>
            </form>
                ';
            }
        }else{
            echo '<h3 class="text-center mt-4 text-shadow">No order found!</h3>';
        }
        echo $output;
    }

    if(isset($_POST['update_order'])){
      try {
        $id = $util->test_input($_POST['order_id']);
        $payment_status = $util->test_input($_POST['procedure']);
        $update = $util->updatePaymentStatus($payment_status,$id);
        if(isset($update)){
            $util->showMessage('success','Payment staus updated!');
        }else{
            $util->showMessage('warning','Payment staus not updated!');
        }
      } catch (\Throwable $th) {
        throw $th;
      }
    }

    if(isset($_POST['get_del_id'])){
        $id= $util->test_input($_POST['get_del_id']);
        $util->deleteOrder($id);
    }

    // admin account
    if(isset($_POST['display_admin'])){
        $output = '';
        $data = $util->displayAdmin();
       
            $output.='
            <thead>
            <tr class="text-center">
                <th>Admin id</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            ';
             if($data){
                
            foreach($data as $row){
                $admin_id = $_SESSION['admin_id'];
                if($row['id'] == $admin_id){
                    $output .= '';
                } else {
                    $output .= '
                    <tr class="alligned-middle text-center">
                    <td>00' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>
                        <button id="' . $row['id'] . '" class="btn text-danger delIconAdmin"><i class="fas fa-trash-alt"></i></button>
                    </td>
                    </tr>
                    ';
                }
                
            }
        $output.='</tbody>';
        }else{
            echo '<h3 class="text-center mt-4 text-shadow">No admin found!</h3>';
        }
        echo $output;
    }
    if(isset($_POST['get_admin_id'])){
        $id = $util->test_input($_POST['get_admin_id']);
        $delete_admin = $util->modifiedAdminAcc($id);
        if($delete_admin){
            $util->delProductCart($id);
            $util->delProductWishlist($id);
            $util->delMessage($id);
            $util->delOrder($id);
        }
    }

    // user accounts 
    if(isset($_POST['display_users'])){
        $output = ''; 
        $data = $util->displayUsers();
        $output.='
            <thead>
            <tr class="text-center">
                <th>User id</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Created Time</th>
                <th>Updated Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            ';
             if($data > 0){
            foreach($data as $row){
                $output .= '
                <tr class="alligned-middle text-center">
                <td>00' . $row['id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['created_at'] . '</td>
                <td>' . $row['updated_at'] . '</td>
                <td>
                    <button id="' . $row['id'] . '" class="btn text-danger delIconUser"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cone-striped" viewBox="0 0 16 16">
                    <path d="m9.97 4.88.953 3.811C10.159 8.878 9.14 9 8 9c-1.14 0-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12zm-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4c.618 0 1.2-.036 1.725-.098zm4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257 2.391.598z"/>
                  </svg></button>
                </td>
                </tr>
                ';    
            }
        $output.='</tbody>';
        }else{
            echo '<h3 class="text-center mt-4 text-shadow">No users found!</h3>';
        }
        echo $output;
    }
    if(isset($_POST['get_user_id'])){
        $id = $util->test_input($_POST['get_user_id']);
        $delete_user = $util->modifiedUserAcc($id);
        if($delete_user){
            $util->delProductCart($id);
            $util->delProductWishlist($id);
            $util->delMessage($id);
            $util->delOrder($id);
        }
    }
    // message control 
    if(isset($_POST['display_messages'])){
        $output = ''; 
        $data = $util->displayMessages();
        $output.='
            <thead>
            <tr>
                <th>ID</th>
                <th>User id</th>
                <th>Name</th>
                <th>E-Mail</th>
                <th>Number</th>
                <th>Messages</th>
                <th>Create Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            ';
             if($data > 0){
            foreach($data as $row){
                $output .= '
                <tr class="alligned-middle text-center">
                <td>00' . $row['id'] . '</td>
                <td>' . $row['user_id'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['email'] . '</td>
                <td>' . $row['number'] . '</td>
                <td>' . substr($row['message'],0,20) . '..</td>
                <td>' . $row['created_at'] . '</td>
                <td>
                    <button id="' . $row['id'] . '" class="btn text-primary delIconMessages"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                    <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                  </svg></button>
                  <button id="' . $row['id'] . '" class="btn text-warning replyIconBtn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                  <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                </svg></button>
                </td>
                </tr>
                ';    
            }
        $output.='</tbody>';
        }else{
            echo '<h3 class="text-center mt-4 text-shadow">No users found!</h3>';
        }
        echo $output;
    }
    if(isset($_POST['get_message_id'])){
            $id = $util->test_input($_POST['get_message_id']);
            $delete_message = $util->removeMessages($id);
        }
    
    // category control 
    if(isset($_POST['confirm_category'])){
       $name = $util->test_input($_POST['name']);
       $slug = $util->test_input($_POST['slug']);
       $image_name = $_FILES['image']['name'];
       $image_size = $_FILES['image']['size'];
       $image_tmp_name = $_FILES['image']['tmp_name'];
       $image_exist = $util->select_cetegories_name($name);
       
       $ext = pathinfo($image_name,PATHINFO_EXTENSION);
       $image_dir = '../image_uploaded/category/';
       $image_unique_name = uniqid(). '.'.$ext;
       $image_path = $image_dir. $image_unique_name;

       if($ext!= 'jpg' && $ext!= 'png' && $ext!= 'jpeg' && $ext!= 'webp' && $ext!= 'jfif'){
        $util->showMessage('warning','Image not match extention!');
       }elseif($image_size > 1000*1000*3){
        $util->showMessage('warning','Image size is too large!');
       }elseif($image_exist){
        $util->showMessage('warning','Categories already added!');
       }else{
        move_uploaded_file($image_tmp_name,$image_path);
        $util->addCategory($name,$image_unique_name,$slug);
        $util->showMessage('success','Category added successfully');
       }
    }
 
    if(isset($_POST['fetch_category'])){
        $output = '';
        $data = $util->displayCategory();
        if($data > 0 ){
           
                $output.='
                <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                ';
                foreach($data as $row){
                $output .= '
                    <tr class="alligned-middle text-center">
                    <td>00' . $row['id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['slug'] . '</td>
                    <td><img src="../image_uploaded/category/' . $row['image'] . '" width="50" height="50" alt="Image"></td>
                    <td>
                        <button id="' . $row['id'] . '" class="btn text-danger delIconCat"><i class="fas fa-trash-alt"></i></button>
                        <button id="' . $row['id'] . '" class="btn text-warning editIconCat"><i class="fas fa-edit" data-bs-toggle="modal" data-bs-target="#editCategoryModal"></i></button>
                    </td>
                    </tr>
                    ';
                }
            $output.='</tbody>';
            }else{
                echo '<h3 class="text-center mt-4 text-shadow">No Categories found!</h3>';
            }
        echo $output;
    }

    if(isset($_POST['get_cat_id'])){
        $id = $util->test_input($_POST['get_cat_id']);
        $data = $util->editCategory($id);
        echo json_encode($data);
    }
    if(isset($_POST['confirm_edit_category'])){
        $edit_id = $util->test_input($_POST['id']);
        $name = $util->test_input($_POST['edit-name']);
        $slug = $util->test_input($_POST['edit-slug']);
        $image_name = $_FILES['edit-image']['name'];
        $image_size = $_FILES['edit-image']['size'];
        $image_tmp_name = $_FILES['edit-image']['tmp_name'];
        $old_image = $util->test_input($_POST['old-image']);
        
        $edit_ext = pathinfo($image_name,PATHINFO_EXTENSION);
        $image_dir = '../image_uploaded/category/';
        $image_unique_name = uniqid(). '.'.$edit_ext;
        $image_path = $image_dir. $image_unique_name;

        if(!empty($image_name)){
            // Check if the file is an actual image
            if(getimagesize($image_tmp_name) !== false){
                // Delete the old image if it exists
                if($old_image != null){
                    unlink('../image_uploaded/category/'.$old_image);
                }
                move_uploaded_file($image_tmp_name, $image_path);
            } else {
                $util->showMessage('danger', 'Invalid image file');
                // Handle the error condition as per your requirements.
            }
        } else {
            $image_unique_name = $old_image;
        }
    
        if($util->updateCategory($name, $image_unique_name, $slug, $edit_id)){
            $util->showMessage('success', 'Category has been updated!');
        } else{
            $util->showMessage('danger', 'Something went wrong!');
        }
    }
    if(isset($_POST['delete_categories'])){
        $id = $util->test_input($_POST['id']);
       $data = $util->deleteCategory($id);
       if($data){
        echo 'success';
       }else{
        echo 'error';
       }
    }


?>