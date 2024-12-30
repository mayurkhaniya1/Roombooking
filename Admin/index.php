<?php
require_once ('essentials.php');
require_once ('db_config.php');

session_start();
if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <?php
    require_once ('css/csslink.php');
    ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }

        .password-field {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;

        }
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white overflow-hidden">
        <form method="POST">
            <h4 class="py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input type="text" name="admin_name" required class="form-control text-center"
                        placeholder="Admin Name">
                </div>
                <div class="mb-4 password-field">
                    <input type="password" name="admin_pswrd" required id="password" class="form-control text-center"
                        placeholder="Password">
                    <span class="toggle-password"><i class="bi bi-eye-fill"></i></span>
                </div>

                <button type="submit" name="login" class="btn text-white custom-bg">Login</button>
            </div>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.querySelector('.toggle-password');
        const eyeIcon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
            }
        });
    </script>

    <?php
    if (isset($_POST['login'])) {
        $frm_data = filtration($_POST);

        $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_password`=?";
        $values = [$frm_data['admin_name'], $frm_data['admin_pswrd']];

        $result = select($con, $query, $values, "ss");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();            
            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('dashboard.php');
        } else {
            alert('error', 'Login failed - Invalid essentials');
        }
    }
    ?>

    <?php
    require_once ('js/jslink.php');
    ?>
</body>

</html>