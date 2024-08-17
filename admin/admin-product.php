<?php 
    require_once '../components/admin_header.php';
    require_once '../components/config.php';
    $data = new Database();
    $category = $data->selectCategory();
    $fetch_category = $data->fetchProductCat();

?>
<div class="row admin-content">
<div class="col-md-12">
<button class="btn-add" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fas fa-circle-plus"></i>&nbsp; Add Product </button>
<button class="btn-del mx-2" type="submit" id="deleteAllProduct" ><i class="fas fa-trash-alt"></i>&nbsp; Delete all product </button>
</div>
    <div class="col-12 my-2"><h3 class="text-uppercase">Product Added</h3></div>
        <div class="col-md-12 mb-2">
            <div id="alertAddProduct"></div>
            <table class="table table-responsive table-hover py-2" id="displayTbl">
           
            <div id="loading-message" style="display: none; text-align: center;">
                <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow spinner-grow-sm text-secondary" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow spinner-grow-sm text-success" role="status">
                <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            </table>
        </div>
        
</div>
</div>
</div>
</div>
<!--Add Modal -->
<div class="modal fade" id="addProductModal" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add product</h1>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="times"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="product p-2">
                <div id="message_alert"></div>
                <form action="#" method="post" id="add-product-form" enctype="multipart/form-data">
                <div class="flex">
                   <div class="form-group">
                   <select name="category_id" id="category_id" class="box mx-auto">
                        <option value="0">--SELECT CATEGORY--</option>
                        <?php 
                            foreach($category as $row){
                                ?>
                                <option value="<?= $row['id']; ?>"><?= $row['name']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                   </div>
                </div>
                    <div class="flex">
                        <div class="form-group">
                            <label for="">Product name</label>
                            <input type="text" name="product_name" id="product_name" class="box" placeholder="enter product name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Image 01</label>
                            <input type="file" name="product_01" id="product_01" class="box" required>
                             <div id="preview_image" style="width: 100; height: 100;"></div>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="form-group">
                            <label for="">Image 02</label>
                            <input type="file" name="product_02" id="product_02" class="box">
                            <div id="preview_image2" style="width: 100; height: 100;"></div>
                        </div>
                        <div class="form-group">
                            <label for="">Image 03</label>
                            <input type="file" name="product_03" id="product_03" class="box">
                            <div id="preview_image3" style="width: 100; height: 100;"></div>
                        </div>
                        </div>
                        <div class="flex">
                        <div class="form-group">
                            <label for="">Product price</label>
                            <input type="text" min="0" max="9999999" name="product_price" id="product_price" class="box" placeholder="enter product price" required>
                        </div>
                        <div class="form-group">
                            <label for="">Details of Products</label>
                            <textarea name="product_detail" id="product_detail" cols="1" rows="1" placeholder="enter product details" class="box"></textarea>
                        </div>
                    </div>

                        <div class="form-group"><button class="btn btn-primary" type="submit" id="btnAddProduct">Add Product</button></div>
                        <span class="d-flex justify-content-center" >
                            <button class="btn btn-primary loadering" disabled style="display: none;">
                                <span class="spinner-border spinner-border-sm"></span>
                                Loading..
                            </button>
                        </span>
                    </form>
            </div>
        </div>
    
    </div>
    </div>
</div>

<!--Edit Modal -->
<div class="modal fade" id="editProductModal" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update product</h1>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="times"><i class="fas fa-times"></i></button>
        </div>
        <div id="alertUpdateProError"></div>
        <div class="modal-body">
            <div class="edit-product p-2">
                <!-- <div id="message_alert"></div> -->
                <form action="#" method="post" id="edit-product-form" enctype="multipart/form-data">
                       <div class="main-box">
                            <div class="main-image">
                                <img class="main-img" id="main-img" src="" alt="">
                            </div>
                            <div class="sub-image">
                                <img class="sub-img" id="sub-img-01" src="" alt="">
                                <img class="sub-img" id="sub-img-02" src="" alt="">
                                <img class="sub-img" id="sub-img-03" src="" alt="">
                            </div>
                       </div>

                        <input type="hidden" name="edit_image_id" id="edit_image_id">
                        <input type="hidden" name="old_image_01" id="old_image_01">
                        <input type="hidden" name="old_image_02" id="old_image_02">
                        <input type="hidden" name="old_image_03" id="old_image_03">

                        <div class="form-group">
                        <label for="">Category</label>
                        <select name="edit_category_id" id="edit_category_id" class="box">
                        <!-- <option value="select" selected disabled>-SELECT CATEGORY-</option> -->
                                <?php 
                                    foreach($fetch_category as $row){
                                        $selected = ($row['name'] === 'true') ? 'selected' : '';
                                        ?>
                                         <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?= $row['name']; ?></option>
                                        <?php
                                    }
                                ?>
                             
                        </select>
                        </div>
                       <div class="form-group">
                        <label for="">Update name</label>
                        <input class="box" type="text" name="edit-name" id="edit-name" placeholder="enter your name" required>
                       </div>
                       <div class="form-group">
                        <label for="">Update price</label>
                        <input class="box" type="text" name="edit-price" id="edit-price" placeholder="enter product price" required>
                       </div>
                       <div class="form-group">
                        <label for="">Update details</label>
                        <textarea class="box" name="edit-detail" id="edit-detail" cols="4" rows="3" placeholder="detail of products here..."></textarea>
                       </div>
                       <div class="form-group">
                       <label for="">Update image 1</label>
                        <input class="box" type="file" name="edit_image_01" id="edit_image_01">
                        <div id="preview_edit_image1" style="width: 100px; height: 100;"></div>
                       </div>
                       <div class="form-group">
                       <label for="">Update image 2</label>
                        <input class="box" type="file" name="edit_image_02" id="edit_image_02">
                        <div id="preview_edit_image2" style="width: 100px; height: 100;"></div>
                       </div>
                       <div class="form-group">
                       <label for="">Update image 3</label>
                        <input class="box" type="file" name="edit_image_03" id="edit_image_03">
                        <div id="preview_edit_image3" style="width: 100px; height: 100;"></div>
                       </div>

                        <div class="form-group"><button class="btn btn-primary" type="submit" id="btnUpdateProduct">Update Product</button></div>
                        <span class="d-flex justify-content-center" >
                            <button class="btn btn-primary loadering" disabled style="display: none;">
                                <span class="spinner-border spinner-border-sm"></span>
                                Loading..
                            </button>
                        </span>
                    </form>
            </div>
        </div>
    
    </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('#product_01').change(function(evt){
            src = URL.createObjectURL(evt.target.files[0]);
            $('#preview_image').html(`<img src="${src}" class="img-thumbnail img-fluid" alt="">`);
        });
        $('#product_02').change(function(evt){
            src = URL.createObjectURL(evt.target.files[0]);
            $('#preview_image2').html(`<img src="${src}" class="img-thumbnail img-fluid" alt="">`);
        });
        $('#product_03').change(function(evt){
            src = URL.createObjectURL(evt.target.files[0]);
            $('#preview_image3').html(`<img src="${src}" class="img-thumbnail img-fluid" alt="">`);
        });

        $('#edit_image_01').change(function(evt){
            src = URL.createObjectURL(evt.target.files[0]);
            $('#preview_edit_image1').html(`<img src="${src}" class="img-thumbnail img-fluid" alt="">`);
        });
        $('#edit_image_02').change(function(evt){
            src = URL.createObjectURL(evt.target.files[0]);
            $('#preview_edit_image2').html(`<img src="${src}" class="img-thumbnail img-fluid" alt="">`);
        });
        $('#edit_image_03').change(function(evt){
            src = URL.createObjectURL(evt.target.files[0]);
            $('#preview_edit_image3').html(`<img src="${src}" class="img-thumbnail img-fluid" alt="">`);
        });

        // add product 
        $(document).on('submit','#add-product-form',function(e){
            e.preventDefault();
            let form = new FormData(this);
            form.append('add-product',1);

            $.ajax({
                url: '../components/action.php',
                method: 'post',
                data: form,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#btnAddProduct').hide();
                    $('.loadering').show();
                },
                success: function(response){
                    if(response.success){
                        $('#btnAddProduct').show();
                        $('.loadering').hide();
                        $('#add-product-form')[0].reset();
                        $('#addProductModal').hide();
                        $('#alertAddProduct').html(response);
                        displayProduct();
                    }else{
                        $('#btnAddProduct').show();
                        $('.loadering').hide();
                        $('#addProductModal').modal('hide');
                        $('#alertAddProduct').html(response);
                        $('#add-product-form')[0].reset();
                        displayProduct();
                    }
                }
            }) 
        });

        // displayProduct 
        displayProduct();
        function displayProduct(){
            $.ajax({
                url: '../components/action.php',
                method: 'post',
                data: {fetch_product:1},
                success: function(response){
                    if(response){
                    $("#displayTbl").html(response);
                    $("table").DataTable({
                      order: [0,'desc']
                    });
                    }
                }
            });
        }

        // delete product
        $(document).on('click','.btnIconDelPro',function(e){
            e.preventDefault();
            get_del_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to delete this product",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "../components/action.php",
                        method: "post",
                        data: {get_del_id:get_del_id},
                        cache: false,
                        success:function(response){
                            status = response.status;
                               if(status == 'success'){
                                displayProduct();
                               }else{
                                displayProduct();
                               }
                        }
                    });
                }
                })
        });
        // control image 
        $('.edit-product .main-box .sub-image .sub-img').click(function() {
            var src = $(this).attr('src');
            $('.edit-product .main-box .main-image .main-img').attr('src', src);
        });
        // end product  
        $(document).on('click','.btnIconEditPro',function(e){
            e.preventDefault();
            get_pro_id = $(this).attr('id');
            $.ajax({
                url: "../components/action.php",
                method: "post",
                data: {get_pro_id:get_pro_id},
                cache: false,
                success: function(response){
                    json = JSON.parse(response);
                    $("#edit_image_id").val(json.id);
                    $("#main-img").attr("src",`../image_uploaded/${json.image_01}`);
                    $("#sub-img-01").attr("src",`../image_uploaded/${json.image_01}`);
                    $("#sub-img-02").attr("src",`../image_uploaded/${json.image_02}`);
                    $("#sub-img-03").attr("src",`../image_uploaded/${json.image_03}`);
                    $('#edit-name').val(json.name);
                    $('#edit_category_id').val(json.category_id);
                    $('#edit-price').val(json.price);
                    $('#edit-detail').val(json.details);
                    $('#old_image_01').val(json.image_01);
                    $('#old_image_02').val(json.image_02);
                    $('#old_image_03').val(json.image_03);
                    
                }
            })
        });

        // update product 
        $(document).on('submit','#edit-product-form',function(e){
            e.preventDefault();
            var form = new FormData(this);
            form.append('update_product_confirm',1);
            
            $.ajax({
                url: "../components/action.php",
                method: "post",
                data: form,
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#btnUpdateProduct').hide();
                    $('.loadering').show();
                },
                success: function(response){
                    if(response.success){
                        $('#btnUpdateProduct').show();
                        $('.loadering').hide();
                        $('#editProductModal').modal('hide');
                        displayProduct();
                    }else{
                        $('#btnUpdateProduct').show();
                        $('.loadering').hide();
                        $('#editProductModal').modal('hide');
                        $('#alertUpdateProError').html(response);
                        displayProduct();
                    }
                }
            })
        });
     
        // delete all product 
        $(document).on('click','#deleteAllProduct',function(e){
            e.preventDefault();
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                url: "../components/action.php",
                method: "post",
                data: "confirm_all_product",
                cache: false,
                success: function(response){
                    displayProduct();
                    Swal.fire(
                    'Deleted!',
                    'Your product has been delete all!',
                    'success'
                    )
                }
            })
            }
            })
        });
            
        // loadering 
        $(window).on('beforeunload',function(){
            $('#loading-message').show();
        });


        // end script 
        });
</script>
