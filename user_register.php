
<?php include 'components/user_header.php' ?>

<section class="user_login">
    <form action="#" method="post" id="user_register_form" class="needs-validation" novalidate>
        <h2>register now</h2>
        <div id="alertRegister"></div>
        <input type="text" class="re-box" name="name" id="name" placeholder="enter your username" required>
        <div class="invalid-feedback">Username field is required!</div>
        <input type="email" class="re-box" name="email" id="email" placeholder="enter your email" required>
        <div class="invalid-feedback">Email field is required!</div>
        <input type="password" class="re-box" name="password" id="password" placeholder="enter your password" required>
        <div class="invalid-feedback">Password field is required!</div>
        <input type="password" class="re-box" name="cpassword" id="cpassword" placeholder="comfirm your password" required>
        <div class="invalid-feedback">Please confirm password!</div>
        <input type="submit" class="btn btn-primary" id="registerBtn" value="Register">
        <span class="d-flex justify-content-center" >
            <button class="btn btn-primary loadering" disabled style="display: none;">
                <span class="spinner-border spinner-border-sm"></span>
                Loading..
            </button>
        </span>
        <p>already have an account?</p>
        <a href="user_login.php" class="btn btn-warning">Login Now</a>
    </form>
</section>
      
<?php include 'components/user_footer.php' ?>

<script>
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


    $(document).ready(function(){
        $(document).on('submit','#user_register_form',function(e){
            e.preventDefault();
            $.ajax({
                url: 'packages/process.php',
                method: 'post',
                data: $(this).serialize()+'&action=register',
                cache: false,
                beforeSend: function(){
                    $('#registerBtn').hide();
                    $('.loadering').show();
                },
                success:function(response){ 
                    if(!response.success){
                        $('#registerBtn').show();
                        $('.loadering').hide();
                        $('#alertRegister').html(response);
                    }else{
                        $('#registerBtn').show();
                        $('.loadering').hide();
                        $('#alertRegister').html(response);
                        $('#user_register_form')[0].reset();
                    }
                }
            })
        });
    });
</script>