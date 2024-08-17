<?php 
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:user_login.php');
}
include 'components/user_header.php';
include 'packages/database.php';
$data = new Database();
$check_order_exist = $data->countProOrders($user_id);
$fetch_orders = $data->displayProOrders($user_id); 


?>
    
    
    <h2 class="order-heading mt-5">placed orders</h2>
    <section class="orders">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Place on</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($check_order_exist > 0){
                    foreach($fetch_orders as $row){
                        $statusClass = ($row['payment_status'] == 'completed') ? 'text-primary' : 'text-danger';
                        ?>
                        <tr>
                        <td><?= $row['name']; ?></td>
                        <td>$<?= $row['total_price']; ?> /-</td>
                        <td><?= $row['placed_on']; ?></td>
                        <td class="<?= $statusClass; ?>"><?= $row['payment_status']; ?></td>
                        <td><button id="<?= $row['id']; ?>" type="button" class="btn PopupOrder" data-bs-toggle="modal" data-bs-target="#OrderModal"><i class="fas fa-eye"></button></i></td>
                    </tr>
                        <?php
                    }
                }else{
                    echo '<h4 class="text-center text-shadow py-3">No product order!!</h4>';
                }
                ?>

            </tbody>
        </table>
    </section>
    <!-- Modal -->
<div class="modal fade" id="OrderModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Details Order</h1>
        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="times"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="row" id="displayPopup">
            <div class="text-center position-relative">
                <div class="spinner-border position-absolute top-25" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            </div>
    
        </div>
    </div>
    </div>
</div>

    <?php include 'components/user_footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function(){
     
        $(document).on('click','.PopupOrder',function(e){
            e.preventDefault();
            get_orderId = $(this).attr("id");
            $.ajax({
                url: "packages/process.php",
                method: "post",
                data: {get_orderId:get_orderId},
                cache: false,
            }).done(function(res){
                $('#displayPopup').html(res);
            });
        });

    });
</script>