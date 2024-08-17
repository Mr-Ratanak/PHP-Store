<?php
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}
include 'components/user_header.php';



?>


<section class="user_login">
<div id="alertProfileUpd"></div>
    <div class="update-user"></div>
      
</section>
      
<?php include 'components/user_footer.php' ?>

<script>

    $(document).ready(function(){

        fetchProfile();
        function fetchProfile(){
            $.ajax({
                url: "packages/process.php",
                method: "post",
                data: "fetch_profile",
                cache: false,
                success: function(response){
                   $('.update-user').html(response);
                }
            })
        }


         $(document).on('submit','#update-profile-form',function(e){
            e.preventDefault();
            $.ajax({
                url: 'packages/process.php',
                method: 'post',
                data: $(this).serialize()+'&action=update-profile',
                cache: false,
                beforeSend: function(){
                    $('#updateProUserBtn').hide();
                    $('.loadering').show();
                },
                success:function(response){ 
                    if(response){
                        $('#updateProUserBtn').show();
                        $('.loadering').hide();
                        $('#alertProfileUpd').html(response);
                        fetchProfile();
                    }else{
                        $('#updateProUserBtn').show();
                        $('.loadering').hide();
                        $('#alertProfileUpd').html(response);
                        fetchProfile();
                    }
                }
            })
        });

      
    });
</script>