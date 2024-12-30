<?php

require_once('../admin/db_config.php');
require_once('../admin/essentials.php');
date_default_timezone_set('Asia/kolkata');
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($email, $token, $type)
{
    if ($type == "email_confirmation") {
        $page = 'Design/email_confirm.php';
        $subject = 'Account Verification Link';
        $content = 'confirm your email';
    } else {
        $page = 'Design/index.php';
        $subject = 'Account Reset Link';
        $content = 'reset your password';
    }
    //Load Composer's autoloader
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // Email sending logic using environment variables (replace placeholders)

    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.gmail.com';                       // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = HOTEL_EMAIL;                          // SMTP username
    $mail->Password = MAIL_API_KEY;                       // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
    $mail->Port = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Recipients
    $mail->setFrom(HOTEL_EMAIL, HOTEL_NAME);
    $mail->addAddress($email);                 // Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = "Click the link to $content:<br>
                            <a href='" . SITE_URL . "$page?$type&email=$email&token=$token'" . ">CLICK ME</a>";

    if ($mail->send()) {
        return 1;
    } else {
        return 0;
    }

}

if (isset($_POST['register'])) {
    $data = filtration($_POST);
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit();
    }
    // check user exists or not
    $u_exist = select($con, "SELECT * FROM `user_cred` WHERE `email`=? OR `phoneno`=? LIMIT 1", [$data['email'], $data['phoneno']], 'si');

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        echo ($u_exist_fetch['email'] == $data['email']) ? 'email_already' : 'phone_already';
        exit();
    }
    $fname = $data['name'] . ' ' . $data['surname'];
    // upload user image to server

    $img = uploadUserImage($_FILES['profile']);
    if ($img == 'inv_img') {
        echo 'inv_img';
        exit();
    } else if ($img == 'upd_failed') {
        echo 'upd_failed';
        exit();
    }

    //send confirmation link to user's email address
    $token = bin2hex(random_bytes(16));

    if (!send_mail($data['email'], $token, "email_confirmation")) {
        echo 'mail_failed';
        exit();
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    $query = "INSERT INTO `user_cred`(`name`, `surname`, `email`, `address`, `phoneno`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?,?,?,?,?,?,?,?,?,?)";

    $values = [$data['name'], $data['surname'], $data['email'], $data['address'], $data['phoneno'], $data['pincode'], $data['dob'], $img, $enc_pass, $token];

    if (insert($con, $query, $values, 'ssssiissss')) {
        echo 1;
    } else {
        echo 'ins_failed';
    }
}

if (isset($_POST['login'])) {
    $data = filtration($_POST);

    $u_exist = select($con, "SELECT * FROM `user_cred` WHERE `email`=? OR `phoneno`=? LIMIT 1", [$data['email_mobile'], $data['email_mobile']], 'si');

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email_mobile';
        exit();
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        $fname = $u_fetch['name'] . ' ' . $u_fetch['surname'];
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            if (!password_verify($data['pass'], $u_fetch['password'])) {
                echo 'invalid_pass';
            } else {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uid'] = $u_fetch['id'];
                $_SESSION['uname'] = $fname;
                $_SESSION['upic'] = $u_fetch['profile'];
                $_SESSION['uphone'] = $u_fetch['phoneno'];
                echo 1;
            }
        }
    }
}

if (isset($_POST['forgot_pass'])) {
    $data = filtration($_POST);

    $u_exist = select($con, "SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']], 's');

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email';
        exit();
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        $fname = $u_fetch['name'] . ' ' . $u_fetch['surname'];
        if ($u_fetch['is_verified'] == 0) {
            echo 'not_verified';
        } else if ($u_fetch['status'] == 0) {
            echo 'inactive';
        } else {
            //send reset link to email
            $token1 = bin2hex(random_bytes(16));
            if (!send_mail($data['email'], $token1, "account_recovery")) {
                echo 'mail_failed';
            } else {
                $date = date("Y-m-d");
                $query = mysqli_query($con, "UPDATE `user_cred` SET `token`='$token1',`t_expire`='$date' WHERE `id`='$u_fetch[id]'");

                if ($query) {
                    echo 1;
                } else {
                    echo 'upd_failed';
                }
            }
        }
    }
}

if (isset($_POST['recover_user'])) {
    $data = filtration($_POST);

    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit();
    } else {
        $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

        $query = "UPDATE `user_cred` SET `password`=?, `token`=?, `t_expire`=? WHERE `email`=? AND `token`=?";

        $values = [$enc_pass, null, null, $data['email'], $data['token']];

        if (update($con, $query, $values, 'sssss')) {
            echo 1;
        } else {
            echo 'upd_failed';
        }
    }
}