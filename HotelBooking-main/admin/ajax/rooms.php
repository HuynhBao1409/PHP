<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_room'])) {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    $frm_data = filteration($_POST);

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['description']
    ];

    if (insert($q1, $values, 'siiiiis')) {
        $room_id = $GLOBALS['con']->insert_id;

        $q2 = "INSERT INTO `room_facilities` (`room_id`, `facility_id`) VALUES (?,?)";
        $q3 = "INSERT INTO `room_features` (`room_id`, `feature_id`) VALUES (?,?)";

        $stmt2 = mysqli_prepare($GLOBALS['con'], $q2);
        $stmt3 = mysqli_prepare($GLOBALS['con'], $q3);

        if ($stmt2 && $stmt3) {
            mysqli_begin_transaction($GLOBALS['con']);

            try {
                foreach ($facilities as $f) {
                    mysqli_stmt_bind_param($stmt2, 'ii', $room_id, $f);
                    mysqli_stmt_execute($stmt2);
                }

                foreach ($features as $f) {
                    mysqli_stmt_bind_param($stmt3, 'ii', $room_id, $f);
                    mysqli_stmt_execute($stmt3);
                }

                mysqli_commit($GLOBALS['con']);
                echo 1;
            } catch (mysqli_sql_exception $exception) {
                mysqli_rollback($GLOBALS['con']);
                echo 0;
                throw $exception;
            } finally {
                mysqli_stmt_close($stmt2);
                mysqli_stmt_close($stmt3);
            }
        } else {
            echo 0;
            throw new Exception('Error preparing SQL statements');
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
                <td>$row[area] sq. ft.</td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Adult: $row[adult];
                    </span><br>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Children: $row[children];
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

if (isset($_POST['get_all_rooms'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
    $v =[$frm_data['value'],$frm_data['toggle_status']];

    if(update($q,$v,'ii')){
        echo 1;
    }else{
        echo 0;
    }
}
?>