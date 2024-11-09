<?php
error_reporting(E_ALL);
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['action']) && $_POST['action'] == 'add_room') {
    // Chuyển đổi chuỗi JSON thành mảng PHP
    $features = json_decode($_POST['features'], true);
    $facilities = json_decode($_POST['facilities'], true);

    // Lọc dữ liệu đầu vào
    $frm_data = filteration($_POST);

    // Log để debug
    error_log("Received data: " . print_r($_POST, true));
    error_log("Features: " . print_r($features, true));
    error_log("Facilities: " . print_r($facilities, true));

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['desc']  // Sửa 'des' thành 'desc' cho đúng với form
    ];

    if (insert($q1, $values, 'siiiiis')) {
        $room_id = mysqli_insert_id($GLOBALS['con']);
        $flag = true;  // Biến kiểm tra lỗi

        if (!empty($facilities)) {
            $q2 = "INSERT INTO `room_facilities` (`room_id`, `facilities_id`) VALUES (?,?)";
            $stmt2 = mysqli_prepare($GLOBALS['con'], $q2);

            if ($stmt2) {
                foreach ($facilities as $f) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $room_id, $f);
                    if (!mysqli_stmt_execute($stmt2)) {
                        $flag = false;
                        break;
                    }
                }
                mysqli_stmt_close($stmt2);
            } else {
                $flag = false;
            }
        }

        if (!empty($features) && $flag) {
            $q3 = "INSERT INTO `room_features` (`room_id`, `features_id`) VALUES (?,?)";
            $stmt3 = mysqli_prepare($GLOBALS['con'], $q3);

            if ($stmt3) {
                foreach ($features as $f) {
                    mysqli_stmt_bind_param($stmt3, 'ii', $room_id, $f);
                    if (!mysqli_stmt_execute($stmt3)) {
                        $flag = false;
                        break;
                    }
                }
                mysqli_stmt_close($stmt3);
            } else {
                $flag = false;
            }
        }

        if ($flag) {
            echo 1;
        } else {
            // Nếu có lỗi, xóa phòng đã thêm
            $delete_room = "DELETE FROM `rooms` WHERE `id` = ?";
            $stmt_delete = mysqli_prepare($GLOBALS['con'], $delete_room);
            mysqli_stmt_bind_param($stmt_delete, 'i', $room_id);
            mysqli_stmt_execute($stmt_delete);
            mysqli_stmt_close($stmt_delete);
            echo 0;
        }
    } else {
        echo 0;
    }
    exit;
}

if (isset($_POST['get_all_rooms'])) {
    $res = selectAll('rooms');
    $i = 1;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {
        if($row['status']==1){
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>active</button>";
        }
        else{
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>inactive</button>";
        }

        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[area]</td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Adult: $row[adult]
                    </span><br>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Children: $row[children]
                    </span>
                </td>
                <td>VND $row[price]</td>
                <td>$row[quantity]</td>
                <td>$status</td>
                <td>
                    <button type='button' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}

if (isset($_POST['toggle_status'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
    $v = [$frm_data['value'], $frm_data['toggle_status']];

    if(update($q, $v, 'ii')){
        echo 1;
    } else {
        echo 0;
    }
}
?>