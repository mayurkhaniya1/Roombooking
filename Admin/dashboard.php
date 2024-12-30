<?php
    require_once('essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php 
    require('css/csslink.php');
    ?>
</head>

<body class="bg-light">
<?php require_once('header.php') ?>
    
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
               Admin Panel - Dashboard
            </div>
        </div>
    </div>
    <?php require_once('js/jslink.php') ?>
</body>

</html>