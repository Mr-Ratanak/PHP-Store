<?php require_once '../components/admin_header.php' ?>     
                <div class="row admin-content">
                    <div class="col-md-12">
                        <button class="del_all_users"><i class="fas fa-trash-alt"></i>&nbsp; Delete All Users </button>
                    </div>
                    <h2 class="heading my-2">user accounts</h2>
                    <div class="col-md-12 my-2">
                        <table class="table table-striped py-2" id="fetchUsers">
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


<script>

    $(document).ready(function(){

    displayUsers();
    function displayUsers(){
        $.ajax({
            url: "../components/action.php",
            method: "post",
            data: "display_users",
            success: function(res){
               if(res){
                $("#fetchUsers").html(res);
                $('table').DataTable({
                    order: [0,'desc']
                })
               }
            }
        })
    }

    $(document).on('click','.delIconUser',function(e){
        e.preventDefault();
        get_user_id = $(this).attr('id');
        
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
            data: {get_user_id:get_user_id},
            cache: false,
            success: function(res){
                Swal.fire(
                'User!',
                'User has been Modified',
                'success'
                )
                displayUsers();
            }
        })
          
        }
        });
    });

    $(window).on('beforeunload',function(){
        $('#loading-message').show();
    })
    // end script 
        });
</script>
