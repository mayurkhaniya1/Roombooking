<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require('../css/csslink.php');
    ?>
    <title><?php echo $settings_r['site_title'] ?> - CONFIRM BOOKING </title>
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

    <?php
    if (!isset($_GET['id']) || $settings_r['shutdown'] == true) {
        redirect('rooms.php');
    } elseif (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('rooms.php');
    }
    // filter and get room and user data
    $data = filtration($_GET);

    $room_res = select($con, "SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "payment" => null,
        "available" => false
    ];

    $user_res = select($con, "SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1", [$_SESSION['uid']], 'i');
    $user_data = mysqli_fetch_assoc($user_res);
    $fname = $user_data['name'] .' '. $user_data['surname'];
    ?>


    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">CONFIRM BOOKING</h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">Rooms</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <?php

                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id` = '$room_data[id]' AND `thumb`= 1");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                echo <<<data
                    <div class="card p-3 shadow-sm rounded">
                        <img src="$room_thumb" class="img-fluid rounded mb-3" alt="Image Not Found">
                        <h5>$room_data[name]</h5>
                        <h6>₹$room_data[price] per night</h6>
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                data;
                ?>
            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">                    
                        <form action="confirm.php" method="POST" id="booking_form">
                            <h6 class="mb-3">BOOKING DETAILS</h6>                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" value="<?php echo $fname ?>" class="form-control"
                                        name="nm" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" value="<?php echo $user_data['phoneno'] ?>"
                                        class="form-control" name="phoneno" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control " rows="2" name="address"
                                        required><?php echo $user_data['address'] ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Check-in</label>
                                    <input name="checkin" onchange="check_availability()" type="date"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Check-out</label>
                                    <input name="checkout" onchange="check_availability()" type="date"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="spinner-border text-info mb-3 d-none" id="info_loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <h6 class="mb-3 text-danger" id="check_msg">Provide Check-in & Check-out date</h6>
                                    <button name="confirm" class="btn w-100 text-white custom-bg mb-1" disabled>Confirm
                                        </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        let booking_form = document.getElementById('booking_form');
        let info_loader = document.getElementById('info_loader');
        let check_msg = document.getElementById('check_msg');

        function check_availability() {
            let checkin_val = booking_form.elements['checkin'].value;
            let checkout_val = booking_form.elements['checkout'].value;
            booking_form.elements['confirm'].setAttribute('disabled', true);

            if (checkin_val != '' && checkout_val != '') {
                check_msg.classList.add('d-none');
                check_msg.classList.replace('text-dark', 'text-danger');
                info_loader.classList.remove('d-none');
                let data = new FormData();
                data.append('check_availability', '');
                data.append('check_in', checkin_val);
                data.append('check_out', checkout_val);

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "../ajax/confirm_booking.php", true);

                xhr.onload = function () {
                    let data = JSON.parse(this.responseText);
                    if(data.status == 'check_in_out_equal'){
                        check_msg.innerText = "You cannot check-out on the same day!";
                    }
                    else if(data.status == 'check_out_earlier'){
                        check_msg.innerText = "Check-out date is earlier than check-in date!";
                    }
                    else if(data.status == 'check_in_earlier'){
                        check_msg.innerText = "Check-in date is earlier than today's date!";
                    }
                    else if(data.status == 'unavailable'){
                        check_msg.innerText = "Room is not available for this check-in date!";
                    }
                    else{
                        check_msg.innerHTML = "No. of Days: "+data.days+ " <br>Total Amount to Pay: ₹"+data.payment;
                        check_msg.classList.replace('text-danger', 'text-dark');
                        booking_form.elements['pay_now'].removeAttribute('disabled');
                    }
                    check_msg.classList.remove('d-none');
                    info_loader.classList.add('d-none');
                }
                xhr.send(data);
            }
        }
    </script>
    <?php
    require('footer.php');
    ?>
    
</body>

</html>