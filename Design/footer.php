<?php
require('../js/jslink.php');
?>
<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
            <p>
            <?php echo $settings_r['site_about'] ?>
            </p>
        </div>
        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="contact_us.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
            <a href="about_us.php" class="d-inline-block mb-2 text-dark text-decoration-none">About us</a><br>
        </div>

        <div class="col-lg-4 p-4">

            <?php
            $hasSocialLinks = false;
            if ($contact_r['fb'] != '') {
                $hasSocialLinks = true;
            }
            if ($contact_r['insta'] != '') {
                $hasSocialLinks = true;
            }
            if ($contact_r['tw'] != '') {
                $hasSocialLinks = true;
            }
            if ($hasSocialLinks) {
                echo '<h5 class="mb-3">Follow us</h5>';
                if ($contact_r['fb'] != '') {
                    echo <<<data
                                    <a href="$contact_r[fb]" class="d-inline-block text-dark fs-5 mb-2 ">                                        
                                            <i class="bi bi-facebook me-1"></i>Facebook
                                    </a>         
                                    <br>
                                data;
                }
                if ($contact_r['insta'] != '') {
                    echo <<<data
                                    <a href="$contact_r[insta]" class="d-inline-block text-dark fs-5 mb-2">                                        
                                        <i class="bi bi-instagram me-1"></i>Instagram
                                    </a> 
                                    <br>                                   
                                data;
                }
                if ($contact_r['tw'] != '') {
                    echo <<<data
                                    <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 mb-2">                                        
                                        <i class="bi bi-twitter-x me-1"></i>Twitter
                                     </a>              
                                     <br>                       
                                 data;
                }
            }
            ?>
        </div>
    </div>
</div>
<h6 class="text-center bg-dark text-white p-3 m-0">Designed and developed by Royal Hotel</h6>
<script>
    let register_form = document.getElementById('register-form');
    register_form.addEventListener('submit', function (event) {
        event.preventDefault();
        register();
    });

    function register() {
        let data = new FormData();
        data.append('name', register_form.elements['rnm'].value);
        data.append('surname', register_form.elements['rsnm'].value);
        data.append('email', register_form.elements['remail'].value);
        data.append('phoneno', register_form.elements['rpno'].value);
        data.append('address', register_form.elements['raddress'].value);
        data.append('pincode', register_form.elements['rpincode'].value);
        data.append('dob', register_form.elements['rdob'].value);
        data.append('pass', register_form.elements['pass'].value);
        data.append('cpass', register_form.elements['cpass'].value);
        data.append('profile', register_form.elements['rimage'].files[0]);
        data.append('register', '');

        var myModal = document.getElementById('Registermodal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../ajax/login_register.php", true);


        xhr.onload = function () {
            if(this.responseText == 'pass_mismatch') {
                alert('error',"Password not match");
            }
            else if(this.responseText == 'email_already') {
                alert('error',"Email is already registered");
            }
            else if(this.responseText == 'phone_already') {
                alert('error',"Phone number is already registered");
            }
            else if(this.responseText == 'inv_img') {
                alert('error',"Only JPG, JPEG, PNG, AND webp images are allowed");
            }
            else if(this.responseText == 'upd_failed') {
                alert('error',"Image upload failed");
            }
            else if(this.responseText == 'mail_failed') {
                alert('error',"Cannot send confirmation email! Server Down!");
            }
            else if(this.responseText == 'ins_failed') {
                alert('error',"Registration failed! Server Down!");
            }
            else{
                alert('success',"Registration successful. Confirmation link sent to email!.")
                register_form.reset();
            }
        }
        xhr.send(data);
    }

    let login_form = document.getElementById('login-form');
    login_form.addEventListener('submit', (event)=>{
        event.preventDefault();
        login();
    });

    function login() {
        let data = new FormData();
       
        data.append('email_mobile', login_form.elements['email_mobile'].value);       
        data.append('pass', login_form.elements['pass'].value);       
        data.append('login', '');

        var myModal = document.getElementById('Loginmodal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../ajax/login_register.php", true);


        xhr.onload = function () {
            if(this.responseText == 'inv_email_mobile') {
                alert('error',"Invalid Email or Mobile number");
            }            
            else if(this.responseText == 'not_verified') {
                alert('error',"Email is not verified!");
            }
            else if(this.responseText == 'inactive') {
                alert('error',"Your account is suspended! Please contact Admin.");
            }
            else if(this.responseText == 'invalid_pass') {
                alert('error',"Wrong password");
            }
            else{               
                let fileurl =window.location.href.split('/').pop().split('?').shift();
                if(fileurl == 'room_details.php'){
                    window.location = window.location.href;
                }
                else{
                window.location = window.location.pathname;
                }
            }
        }
        xhr.send(data);
    }

    let forgot_form = document.getElementById('forgot-form');
    forgot_form.addEventListener('submit', (event)=>{
        event.preventDefault();
        forgot();
    });

    function forgot() {
        let data = new FormData();
       
        data.append('email', forgot_form.elements['email'].value);                   
        data.append('forgot_pass', '');

        var myModal = document.getElementById('forgotmodal');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../ajax/login_register.php", true);


        xhr.onload = function () {
            if(this.responseText == 'inv_email') {
                alert('error',"Invalid Email ");
            }            
            else if(this.responseText == 'not_verified') {
                alert('error',"Email is not verified!");
            }
            else if(this.responseText == 'inactive') {
                alert('error',"Your account is suspended! Please contact Admin.");
            }
            else if(this.responseText == 'mail_failed') {
                alert('error',"Cannot send mail Server Down!");
            }
            else if(this.responseText == 'upd_failed') {
                alert('error',"Password reset failed!");
            }
            else{               
                alert('success',"Reset link send to email");
                forgot_form.reset();
            }
        }
        xhr.send(data);
    }

    function checkLoginToBook(status,room_id) {
        if(status){
            window.location.href = 'confirm_booking.php?id='+room_id;
        }
        else{
            alert('error','Please login to book room!');
        }
    }
</script>
