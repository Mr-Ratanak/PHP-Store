<?php require_once '../components/admin_header.php' ?>  
                <div class="row admin-content">
                    <h2 class="heading my-2">messages</h2>
                    <div class="col-md-12 mb-2">
                        <table id="fetchMessage" class="display table table-bordered my-3 py-2" style="width:100%">
                            
                        </table>
                       </div>
                </div>
            </div>
    </div>
</div>


<script>
    $(document).ready(function(){

        displayMessages();
    function displayMessages(){
        $.ajax({
            url: "../components/action.php",
            method: "post",
            data: "display_messages",
            success: function(res){
               if(res){
                $("#fetchMessage").html(res);
                $('table').DataTable({
                    order: [0,'desc']
                })
               }
            }
        })
    }
    $(document).on('click','.delIconMessages',function(e){
        e.preventDefault();
        get_message_id = $(this).attr('id');
        
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: "../components/action.php",
            method: "post",
            data: {get_message_id:get_message_id},
            cache: false,
            success: function(res){
                Swal.fire(
                'Message!',
                'Message has been remove',
                'success'
                )
                displayMessages();
            }
        })
          
        }
        });
    });
          
    // end script 
        });
</script>
