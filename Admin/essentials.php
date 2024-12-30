<?php
    // Frontend use

    define('SITE_URL','http://127.0.0.1/Roombooking/');
    define('ABOUT_IMG_PATH',SITE_URL.'images/about/');
    define('Carousel_IMG_PATH',SITE_URL.'images/carousel/');
    define('Facilities_IMG_PATH',SITE_URL.'images/facilities/');
    define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
    define('USERS_IMG_PATH',SITE_URL.'images/users/');

    // backend upload process needs this data

define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Roombooking/images/');
define('ABOUT_FOLDER_PATH', 'about/');
define('CAROUSEL_FOLDER_PATH', 'carousel/');
define('FACILITIES_FOLDER_PATH', 'facilities/');
define('ROOMS_FOLDER_PATH', 'rooms/');
define('USERS_FOLDER_PATH', 'users/');

// Mail service component
define('MAIL_API_KEY','jxqsiviuohpxhwrm');
define('HOTEL_EMAIL','cm45986703@gmail.com');
define('HOTEL_NAME','ROYAL HOTEL');
function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        echo "
            <script>window.location.href='index.php';</script>
            ";
    }
}
function redirect($url)
{
    echo "
        <script>window.location.href='$url';</script>
        ";
}
function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            alert;
}

function uploadImage($image, $folder)
{
    $valid_mine = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img'; // invalid image mine or format
    } else if (($image['size'] / (1024 * 1024) > 2)) {
        return 'inv_size'; //invalid greater than 2MB
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $randomName = 'IMG_' . random_int(11111,99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH . $folder . $randomName;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $randomName;
        } else {
            return 'upd_failed';
        }
    }

}

function deleteImage($image, $folder){
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }
    else {
        return false;
    }
}

function uploadSVGImage($image, $folder)
{
    $valid_mine = ['image/svg+xml'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img'; // invalid image mine or format
    } else if (($image['size'] / (1024 * 1024) > 2)) {
        return 'inv_size'; //invalid greater than 2MB
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $randomName = 'IMG_' . random_int(11111,99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH . $folder . $randomName;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $randomName;
        } else {
            return 'upd_failed';
        }
    }

}

function uploadUserImage($image) {
    $valid_mine = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    $img_mine = $image['type'];

    if (!in_array($img_mine, $valid_mine)) {
        return 'inv_img'; // invalid image mine or format
    }else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $randomName = 'IMG_' . random_int(11111,99999).".jpeg";

        $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER_PATH.$randomName;
        if($ext == 'png' || $ext == 'PNG'){
            $img = imagecreatefrompng($image['tmp_name']);
        }
        elseif($ext == 'webp' || $ext == 'WEBP'){
            $img = imagecreatefromwebp($image['tmp_name']); 
        }
        else{
            $img = imagecreatefromjpeg($image['tmp_name']); 
        }

        if (imagejpeg($img,$img_path,75)){
            return $randomName;
        } else {
            return 'upd_failed';
        }
    }
}