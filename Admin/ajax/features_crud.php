<?php

require_once('../db_config.php');
require_once('../essentials.php');
adminLogin();

if (isset($_POST['add_feature'])) {
    $frm_data = filtration($_POST);
    $q = "INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$frm_data['name']];
    $res = insert($con, $q, $values, 's');
    echo $res;

}

if (isset($_POST['get_features'])) {
    $res = selectAll($con, 'features');
    $i = 1;
    while ($data = mysqli_fetch_assoc($res)) {
        echo <<<data
                <tr>
                    <td>$i</td>
                    <td>$data[name]</td>
                    <td><button type="button" onclick="remove_feature($data[id])" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>Delete
                        </button></td>
                </tr>               
            data;
        $i++;
    }
}

if (isset($_POST['remove_feature'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['remove_feature']];

    $check_q = select($con, 'SELECT * FROM `room_feature` WHERE `features_id`=?', [$frm_data['remove_feature']], 'i');

    if (mysqli_num_rows($check_q) == 0) {
        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($con, $q, $values, 'i');
        echo $res;
    } else {
        echo 'room_added';
    }


}

if (isset($_POST['add_facility'])) {
    $frm_data = filtration($_POST);
    $img_r = uploadSVGImage($_FILES['icon'], FACILITIES_FOLDER_PATH);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
        $values = [$img_r, $frm_data['name'], $frm_data['desc']];
        $res = insert($con, $q, $values, 'sss');
        echo $res;
    }
}

if (isset($_POST['get_facilities'])) {
    $res = selectAll($con, 'facilities');
    $i = 1;
    $path = Facilities_IMG_PATH;
    while ($data = mysqli_fetch_assoc($res)) {
        echo <<<data
                <tr class='align-middle'>
                    <td>$i</td>
                    <td><img src="$path$data[icon]" width="100px"></td>
                    <td>$data[name]</td>
                    <td>$data[description]</td>
                    <td><button type="button" onclick="remove_facility($data[id])" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i>Delete
                        </button></td>
                </tr>               
            data;
        $i++;
    }
}

if (isset($_POST['remove_facility'])) {
    $frm_data = filtration($_POST);
    $values = [$frm_data['remove_facility']];

    $check_q = select($con, 'SELECT * FROM `room_facilities` WHERE `facilities_id`=?', [$frm_data['remove_facility']], 'i');

    if (mysqli_num_rows($check_q) == 0) {

        $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
        $res = select($con, $pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['icon'], FACILITIES_FOLDER_PATH)) {
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $res = delete($con, $q, $values, 'i');
            echo $res;
        } else {
            echo 0;
        }
    }
    else {
        echo 'room_added';
    }
}