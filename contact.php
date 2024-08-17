<?php 
session_start();
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:user_login.php');
}
include 'components/user_header.php';


?>
    
    <section class="contact">
        <h2 class="heading">send us message!</h2>
        <form action="#" method="post" id="contact-form" novalidate class="needs-validation"> 
            <input type="text" class="box" name="name" id="name" placeholder="enter your name" required>
            <div class="invalid-feedback">name fields is required!</div>
            <input type="email" class="box" name="email" id="email" placeholder="enter your email" required>
            <div class="invalid-feedback">email fields is required!</div>
            <input type="text" class="box" name="number" id="number" placeholder="enter your number" required>
            <div class="invalid-feedback">number fields is required!</div>
            <textarea class="box" name="messages" id="messages" cols="7" rows="5" placeholder="enter your message here" required></textarea>
            <div class="invalid-feedback">message fields is required!</div>
            <button class="btn btn-primary mt-1" id="btnMessage">Send Message</button>
            <span class="d-flex justify-content-center" >
                <button class="btn btn-primary loadering" disabled style="display: none;">
                    <span class="spinner-border spinner-border-sm"></span>
                    Loading..
                </button>
            </span>
        </form>
    </section>

    <?php include 'components/user_footer.php' ?>

    <script>
(() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

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
})()
        $(document).ready(function(){
            $(document).on('submit','#contact-form',function(e){
                e.preventDefault();
                $.ajax({
                    url: "packages/process.php",
                    method: "post",
                    data: $(this).serialize()+"&contact=confirm_contact",
                    beforeSend: function(){
                        $(".loadering").show();
                        $('#btnMessage').hide();
                    },
                    success: function(res){
                        if(res === 'msg_exist'){
                            $(".loadering").hide();
                            $('#btnMessage').show();
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Messages already sent',
                                timer: false,
                            });
                            // console.log(res);
                        }else if(res === 'msg_success'){
                            $(".loadering").hide();
                            $('#btnMessage').show();
                            alertify.success('Thank You!').dismissOthers();
                            $('#contact-form')[0].reset();
                        }
                        // console.log(res);
                    }
                })
            })
        });
    </script>