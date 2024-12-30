<?php

require_once('../admin/db_config.php');
require_once('../admin/essentials.php');
date_default_timezone_set('Asia/kolkata');

session_start();

$Total_Pay = $_SESSION['room']['payment'];

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
}

if (isset($_POST['confirm'])) {

    $ORDER_ID = 'ORD_' . $_SESSION['uid'] . random_int(11111, 999999);
    $frm_data = filtration($_POST);

    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) VALUES (?,?,?,?,?)";
    insert($con, $query1, [$_SESSION['uid'], $_SESSION['room']['id'], $frm_data['checkin'], $frm_data['checkout'], $ORDER_ID], 'iisss');

    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phoneno`, `address`) VALUES (?,?,?,?,?,?,?)";

    insert($con, $query2, [$booking_id, $_SESSION['room']['name'], $_SESSION['room']['price'], $Total_Pay, $frm_data['nm'], $frm_data['phoneno'], $frm_data['address']], "isiisis");

    echo <<<data
    <div class="col-12 px-4">
        <p class="fw-bold alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            Booking successful.
            <br><br>
            <a href='bookings.php'>Gp to Bookings</a>
        </p>
    </div>
data;
} 
else {
    echo <<<data
    <div class="col-12 px-4">
        <p class="fw-bold alert alert-danger">
            <i class="bi bi-exclamation-triangle-fill"></i>
            Booking failed.
            <br><br>
            <a href='rooms.php'>Gp to Rooms</a>
        </p>
    </div>
data;
}