<?php require_once '../components/admin_header.php' ?>
<div class="row admin-content">
<div class="col-md-12">
<button class="btn-add" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fas fa-circle-plus"></i>&nbsp; Add Category </button>
<button class="btn-del mx-2" type="submit" id="deleteAllProduct" ><i class="fas fa-trash-alt"></i>&nbsp; Delete all category </button>
</div>
    <div class="col-12 my-2"><h3 class="text-uppercase">Category Added</h3></div>
        <div class="col-md-12 mb-2">
        <div id="alert_category"></div>
        <div id="alert_edit_category"></div>
            <table class="table table-responsive table-hover py-2" id="displaytblCat">
           
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
<div class="modal fade" id="addCategoryModal" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add category</h1>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="times"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="product p-2">
                <form action="#" method="post" id="add-category-form" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Category name</label>
                            <input type="text" name="name" id="name" class="box" placeholder="enter category name" required>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="box" placeholder="Enter your slug here" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="box" required>
                             <div id="preview_image" style="width: 100; height: 100;"></div>
                        </div>
                    
                        <div class="form-group"><button class="btn btn-primary" type="submit" id="btnAddCategory">Add Category</button></div>
                        
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
<div class="modal fade" id="editCategoryModal" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit category</h1>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="times"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="product p-2">
                <form action="#" method="post" id="edit-category-form" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                    <input type="hidden" name="old-image" id="old-image">
                        <div class="form-group">
                            <label for="edit-name">Category name</label>
                            <input type="text" name="edit-name" id="edit-name" class="box" placeholder="enter category name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-slug">Slug</label>
                            <input type="text" name="edit-slug" id="edit-slug" class="box" placeholder="Enter your slug here" required>
                        </div>
                        <div class="form-group">
                            <img id="fetch_view_img" src="" alt="" width="50" height="50">
                        </div>
                        <div class="form-group">
                            <label for="edit-image">Image</label>
                            <input type="file" name="edit-image" id="edit-image" class="box">
                             <div id="edit_preview_image" style="width: 50; height: 50; margin-top: .50rem;"></div>
                        </div>
                    
                        <div class="form-group"><button class="btn btn-primary" type="submit" id="editAddCategory">Update Category</button></div>
                        
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
            
    $('#image').on('change',function(evt){
        let src = URL.createObjectURL(evt.target.files[0]);
        $('#preview_image').html(`<img src="${src}" alt="${src}">`);
    });
    $('#edit-image').on('change',function(evt){
        let src = URL.createObjectURL(evt.target.files[0]);
        $('#edit_preview_image').html(`<img src="${src}" alt="${src}">`);
    });

    $(document).on('submit','#add-category-form',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('confirm_category',1);
        $.ajax({
            url: "../components/action.php",
            method: "post",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            // dataType: 'json',
            beforeSend: function(){
                $('#btnAddCategory').hide();
                $('.loadering').show();
            },
            success: function(res){
                if(res){
                    $('#btnAddCategory').show();
                    $('.loadering').hide();
                    $('#add-category-form')[0].reset();
                    $('#addCategoryModal').modal('hide');
                    $('#alert_category').html(res);
                    displayCategories();
                }else{
                    $('#btnAddCategory').show();
                    $('.loadering').hide();
                    $('#alert_category').html(res);
                    displayCategories();
                }
            }
        })
    });

    displayCategories();
    function displayCategories(){
        $.ajax({
            url: '../components/action.php',
            method: 'post',
            cache: false,
            data: {fetch_category:1},
            success: function(res){
                $('#displaytblCat').html(res);
                $('table').DataTable({
                    order: [0,'desc'],
                });
            }
        })
    }

    $(document).on('click','.editIconCat',function(e){
        e.preventDefault();
        get_cat_id = $(this).attr('id');
        $.ajax({
            url: '../components/action.php',
            method: 'post',
            data: {get_cat_id:get_cat_id},
            success: function(res){
                json = JSON.parse(res);
                $('#id').val(json.id);
                $('#edit-name').val(json.name);
                $('#edit-slug').val(json.slug);
                $('#fetch_view_img').attr('src',`../image_uploaded/category/${json.image}`);
                $('#old-image').val(json.image); 
            }
        })
    });
    $(document).on('submit','#edit-category-form',function(e){
        e.preventDefault();
        let formData = new FormData(this);
        formData.append('confirm_edit_category',1);
        $.ajax({
            url: "../components/action.php",
            method: "post",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            // dataType: 'json',
            beforeSend: function(){
                $('#editAddCategory').hide();
                $('.loadering').show();
            },
            success: function(res){
                if(res){
                    $('#editAddCategory').show();
                    $('.loadering').hide();
                    $('#editCategoryModal').modal('hide');
                    $('#alert_edit_category').html(res);
                    displayCategories();
                }else{
                    $('#editAddCategory').show();
                    $('.loadering').hide();
                    $('#alert_edit_category').html(res);
                    displayCategories();
                }
            }
        })

    });

    $(document).on('click','.delIconCat',function(e){
        e.preventDefault();
        id = $(this).attr('id');
       
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this category",
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
            data: {id:id,delete_categories:1},
            success: function(res){
                Swal.fire(
                'Deleted!',
                'You will delete this item from category!',
                'success'
                )
                displayCategories();
            }
        })
               
            }
        });
    });


        // loadering 
        $(window).on('beforeunload', function() {
            $('#loading-message').show();
        });
        // end script 
        });
</script>
