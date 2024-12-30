<?php
require_once('../db_config.php');
require_once('../essentials.php');
adminLogin();

if (isset($_POST['get_users'])) {
    $res = selectAll($con,'user_cred');
    $i = 1;
    $path = USERS_IMG_PATH;
    $data = "";
    while ($row = mysqli_fetch_assoc($res)) {

        $date = date("d-m-Y",strtotime($row['datentime']));

        $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i>
                </button>";
        
        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";
        if($row['is_verified']){
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $del_btn = "";
        }

        $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm'>active</button>";
        if(!$row['status']){
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm'>inactive</button>";
        }

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                <img src='$path$row[profile]' width='55px'>
                <br>
                $row[name]
                </td>
                <td>$row[surname]</td>
                <td>$row[email]</td>
                <td>$row[phoneno]</td>
                <td>$row[address]</td>
                <td>$row[pincode]</td>
                <td>$row[dob]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}

if (isset($_POST['toggle_status'])) {
    $frm_data = filtration($_POST);
    $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if (update($con, $q, $v, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}

if (isset($_POST['remove_user'])) {
    $frm_data = filtration($_POST);    
    
    $res =  delete($con,"DELETE FROM `user_cred` WHERE `id`=? AND `is_verified`=?",[$frm_data['user_id'],0],'ii');
   
    if($res){
        echo 1;
    }
    else {
        echo 0;
    }
}

if (isset($_POST['search_user'])) {
    $frm_data = filtration($_POST);
    $query = "SELECT * FROM `user_cred` WHERE `email` LIKE ?";
    $res = select($con,$query,["%$frm_data[email]%"],'s');
    $i = 1;
    $path = USERS_IMG_PATH;
    $data = "";
    while ($row = mysqli_fetch_assoc($res)) {

        $date = date("d-m-Y",strtotime($row['datentime']));

        $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i>
                </button>";
        
        $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";
        if($row['is_verified']){
            $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
            $del_btn = "";
        }

        $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm'>active</button>";
        if(!$row['status']){
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm'>inactive</button>";
        }

        $data .= "
            <tr>
                <td>$i</td>
                <td>
                <img src='$path$row[profile]' width='55px'>
                <br>
                $row[name]
                </td>
                <td>$row[surname]</td>
                <td>$row[email]</td>
                <td>$row[phoneno]</td>
                <td>$row[address]</td>
                <td>$row[pincode]</td>
                <td>$row[dob]</td>
                <td>$verified</td>
                <td>$status</td>
                <td>$date</td>
                <td>$del_btn</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}