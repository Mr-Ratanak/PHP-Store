
    
    <?php include 'components/user_header.php' ?>
    <section class="user_login">
        <form action="#" method="post" id="user_login_form" class="needs-validation" novalidate>
        <div id="alertLogin"></div>    
            <h2>login now</h2>
            <input type="email" class="re-box" name="email" id="email" placeholder="enter your email" required>
            <div class="invalid-feedback">E-Mail field is required!</div>
            <input type="password" class="re-box" name="password" id="password" oninput="this.value = this.value.replace(/\s/g, '')" placeholder="enter your password" required>
            <div class="invalid-feedback">Password field is required!</div>
            <input type="submit" class="btn btn-primary" id="loginBtn" value="Login">
            <p>don't have an account?</p>
            <a href="user_register.php" class="btn btn-warning">Register Now</a>
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
            $(document).on('submit','#user_login_form',function(e){
                e.preventDefault();
                $('#loginBtn').val('Please Wait...');
                $.ajax({
                    url: "packages/process.php",
                    method: "post",
                    data: $(this).serialize()+"&action=user-login",
                    success: function(res){
                        if(res === 'user_login'){
                            window.location="home.php";
                        }else{
                            $('#alertLogin').html(res);
                            $('#loginBtn').val('Login');
                        }
                    }
                })
            })
        });
    </script>
