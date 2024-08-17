<?Php 
session_start();
$admin_id = $_SESSION['admin_id'];
if(!$admin_id){
    header("location:../admin-login.php");
}

    require_once '../components/admin_header.php';
    require_once '../components/config.php';
    $data = new Database();
    $admin = $data->select_admin($admin_id);
    
?> 

                <div class="row admin-content">
                    <h2 class="heading my-2">update profile</h2>
                    <div class="col-md-6">
                        <div class="view-profile">
                            <p><?php echo $admin['name']; ?></p>
                            <a href="admin-account.php" class="btn btn-warning text-white">Register Admin</a>
                            <a href="../admin-login.php" class="btn btn-primary">Login</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div id="alertUpdateAdProfile"></div>
                       <form action="" method="post" class="profile" id="update-admin-form">
                        <input type="hidden" name="admin_id" id="admin_id" value="<?= $admin['id']; ?>">    
                        <input type="hidden" name="prev_pass" id="prev_pass" value="<?= $admin['password']; ?>">
                            <input type="text" class="box" name="name" id="name" placeholder="enter username" value="<?= $admin['name']; ?>" required>
                            <input type="password" class="box" name="old_pass" id="old_pass" placeholder="enter old password">
                            <input type="password" class="box" name="npass" id="npass" placeholder="enter new password">
                            <input type="password" class="box" name="cpass" id="cpass" placeholder="comfirm password">
                            <div class="btnProf">
                                <button class="btn btn-primary" id="updateAdProfileBtn">Update Profile</button>
                            </div>
                            <span class="d-flex justify-content-center" >
                                <button class="btn btn-primary loadering" disabled style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                    Loading...
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
        $(document).on('submit','#update-admin-form',function(e){
            e.preventDefault();
            $.ajax({
                url: "../components/action.php",
                method: 'post',
                data: $(this).serialize()+"&action=update_admin_profile",
                beforeSend: function(){
                    $('#updateAdProfileBtn').hide();
                    $('.loadering').show();
                },
                success:function(response){
                    if(response.success){
                        $('#updateAdProfileBtn').show();
                        $('.loadering').hide();
                        $("#alertUpdateAdProfile").html(response);
                    }else{
                        $('#updateAdProfileBtn').show();
                        $('.loadering').hide();
                        $("#alertUpdateAdProfile").html(response);
                    }
                }
            })
        })
    });
</script>

