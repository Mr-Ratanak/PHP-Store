<?php require_once '../components/admin_header.php' ?>
   
                <div class="row admin-content">
                    <h2 class="heading my-2">placed orders</h2>
                    <div id="alertUpdateStatus"></div>
                    <div class="col-md-4 wrap-order" id="fetchOrder">
                        
                    </div>
                </div>
            </div>
    </div>
</div>

<script>
    $(document).ready(function(){
           
        displayOrders();
        function displayOrders(){
            $.ajax({
                url: "../components/action.php",
                method: "post",
                data: "display_order",
            }).done(function(response){
                $('#fetchOrder').html(response);
            })
        }
        $(document).on('submit','#order-update-form',function(e){
            e.preventDefault();
            $.ajax({
                url: "../components/action.php",
                method: "post",
                data: $(this).serialize()+ "&update_order",
                cache: false,
                success: function(response){
                    if(!response.success){
                        $('#alertUpdateStatus').html(response);
                        displayOrders();
                    }else{
                        $('#alertUpdateStatus').html(response);
                        displayOrders();
                    }
                }
            })
        });

        $(document).on('click','.DeleteOrder',function(e){
            e.preventDefault();
            get_del_id = $(this).attr("id");
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
                    data: {get_del_id:get_del_id},
                    success: function(res){
                        displayOrders();
                        }
                    });
                }
                })
        });


// end script 
        });   
</script>
