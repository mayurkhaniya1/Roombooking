<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../css/csslink.php');
    ?>
    <title><?php echo $settings_r['site_title'] ?> - Contact US</title>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>

<body class="bg-light">

    <?php
    require('header.php');
    ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Contact us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Doloribus ex magnam nemo <br> voluptatibus, obcaecati
            optio quibusdam soluta impedit nisi expedita.
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 px-4">
                <div class="bg-white rounded p-4">
                    <iframe class="w-100 rounded mb-4" height="320" src="<?php echo $contact_r['iframe'] ?>"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank"
                        class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address'] ?>
                    </a>
                    <h5>Call us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>"
                        class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>+<?php echo $contact_r['pn1'] ?></a>
                    <br>
                    <?php
                    if ($contact_r['pn2'] != '') {
                        echo <<<data
                            <a href="tel: +$contact_r[pn2]" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                            class="bi bi-telephone-fill"></i>+$contact_r[pn2]</a>
                            <br>
                            data;
                    }
                    if ($contact_r['pn3'] != '') {
                        echo <<<data
                            <a href="tel: +$contact_r[pn3]" class="d-inline-block mb-2 text-decoration-none text-dark"><i
                              class="bi bi-telephone-fill"></i>+$contact_r[pn3]</a>
                            data;
                    }
                    ?>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: <?php echo $contact_r['email'] ?>"
                        class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill me-2"></i><?php echo $contact_r['email'] ?>
                    </a>

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
                        echo '<h5 class="mt-4">Follow us</h5>';
                        if ($contact_r['fb'] != '') {
                            echo <<<data
                                    <a href="$contact_r[fb]" class="d-inline-block text-dark fs-5 me-2 ">                                        
                                            <i class="bi bi-facebook me-1"></i>
                                    </a>                                    
                                data;
                        }
                        if ($contact_r['insta'] != '') {
                            echo <<<data
                                    <a href="$contact_r[insta]" class="d-inline-block text-dark fs-5 me-2">                                        
                                        <i class="bi bi-instagram me-1"></i>
                                    </a>                                    
                                data;
                        }
                        if ($contact_r['tw'] != '') {
                            echo <<<data
                                    <a href="$contact_r[tw]" class="d-inline-block text-dark fs-5 me-2">                                        
                                        <i class="bi bi-twitter-x me-1"></i>
                                     </a>                                     
                                 data;
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="name" type="text" class="form-control" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input name="email" type="email" class="form-control" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subject" type="text" class="form-control" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="message" class="form-control " rows="5" required></textarea>
                        </div>
                        <button type="submit" name="send" class="btn text-white custom-bg mt-3">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['send'])) {
        $frm_data = filtration($_POST);
        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];
        $res = insert($con,$q,$values,'ssss');
        if($res == 1){
            alert('success','Message sent!');
        }
        else{
            alert('error','Server Down! Try again later.');
        }
    }
    ?>
    <?php
    require('footer.php');
    ?>
</body>

</html>