<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['add_room'])) {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    $frm_data = filteration($_POST);

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `desc`) VALUES (?,?,?,?,?,?,?)";
    $values = [
        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['desc']
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
    $i = 0;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {
        $data .= "
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[area]</td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Adult: $row[adult];
                    </span><br>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Children: $row[children];
                    </span>
                </td>
                <td>$row[price]</td>
                <td>$row[quantity]</td>
                <td>Status</td>
                <td>Buttons</td>
            </tr>
        ";
        $i++;
    }
    echo $data;
}
?>