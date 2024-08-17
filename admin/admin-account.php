<?php require_once '../components/admin_header.php' ?>     
                <div class="row admin-content">
                    <div class="col-md-12">
                        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#adminRegModal"><i class="fas fa-circle-plus"></i>&nbsp; Register Admin </button>
                    </div>
                    <h2 class="heading my-2">admin accounts</h2>
                    <div class="col-md-12 my-2">
                        <table class="table table-striped py-2" id="fetchAdmin">
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
<!-- Modal -->
<div class="modal fade" id="adminRegModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Register New</h1>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="times"><i class="fas fa-times"></i></button>
        </div>
        <div id="alertRegAdmin"></div>
        <div class="modal-body">
            <div class="product">
                <form action="#" class="needs-validation" method="post" id="admin-register-form" novalidate>
                        <div class="form-group">
                            <input type="text" name="name" id="name" class="box" placeholder="enter your username" required>
                            <div class="invalid-feedback">Username field is required!</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="box" placeholder="enter your password" required>
                            <div class="invalid-feedback">Password field is required!</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="cpassword" id="cpassword" class="box" placeholder="confirm your password" required>
                            <div class="invalid-feedback">Confirm password field is required!</div>
                        </div>
                        <span class="d-flex justify-content-center" >
                            <button class="btn btn-primary loadering" disabled style="display: none;">
                                <span class="spinner-border spinner-border-sm"></span>
                                Loading..
                            </button>
                        </span>
                        <button class="btn btn-primary" type="submit" id="btnRegAdmin">Register Now</button>
                </form>
            </div>
        </div>
    
    </div>
    </div>
</div>

<script>


    $(document).ready(function(){
(() => {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll('.needs-validation');
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
})();
           
    // register admin 
    $(document).on('submit','#admin-register-form',function(e){
        e.preventDefault();
        $.ajax({
            url: "../components/action.php",
            method: "post",
            data: $(this).serialize()+'&action=admin-register',
            beforeSend: function(){
                $('.loadering').show();
            },
            success: function(response){
                if(response.success){
                    $("#alertRegAdmin").html(response);
                    $('.loadering').hide();
                    $("#admin-register-form")[0].reset();
                    $("#adminRegModal").modal('hide');
                }else{
                    $("#alertRegAdmin").html(response);
                    $('.loadering').hide();
                }
            }
        })
    });

    displayAdmin();
    function displayAdmin(){
        $.ajax({
            url: "../components/action.php",
            method: "post",
            data: "display_admin",
            success: function(res){
               if(res){
                $("#fetchAdmin").html(res);
                $('table').DataTable({
                    order: [0,'desc']
                })
               }
            }
        })
    }

    $(document).on('click','.delIconAdmin',function(e){
        e.preventDefault();
        get_admin_id = $(this).attr('id');
        
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: "../components/action.php",
            method: "post",
            data: {get_admin_id:get_admin_id},
            cache: false,
            success: function(res){
                Swal.fire(
                'Admin!',
                'Admin has been remove',
                'success'
                )
                displayAdmin();
            }
        })
          
        }
        });
    });

    $(window).on('beforeunload',function(){
        $('#loading-message').show();
    });
    // end script 
        });
</script>
