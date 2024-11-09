<?php

require ('inc/essentials.php');
require ('inc/db_config.php');
adminLogin();

// Tạo CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    if (isset($_POST['seen_all'])) {
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked all as read');
        } else {
            alert('error', 'Operation Failed');
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['seen_single'])) {
        $sr_no = filter_var($_POST['sr_no'], FILTER_VALIDATE_INT);
        if ($sr_no) {
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
            $values = [1, $sr_no];
            if (update($q, $values, 'ii')) {
                alert('success', 'Marked as read');
            } else {
                alert('error', 'Operation Failed');
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['delete_all'])) {
        $stmt = mysqli_prepare($GLOBALS['con'], "DELETE FROM `user_queries`");
        if (mysqli_stmt_execute($stmt)) {
            alert('success', 'Đã xóa tất cả');
        } else {
            alert('error', 'Xóa thất bại');
        }
        mysqli_stmt_close($stmt);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['delete_single'])) {
        $sr_no = filter_var($_POST['sr_no'], FILTER_VALIDATE_INT);
        if ($sr_no) {
            $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
            $values = [$sr_no];
            if (delete($q, $values, 'i')) {
                alert('success', 'Đã xóa');
            } else {
                alert('error', 'Xóa thất bại');
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if (isset($_POST['action']) && $_POST['action'] == 'add_room') {
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            error_log("CSRF token validation failed");
            echo 0;
            exit;
        }

        // Log request data
        error_log("Received POST data: " . print_r($_POST, true));

        // Validate required fields
        $required_fields = ['name', 'area', 'price', 'quantity', 'adult', 'children', 'desc'];
        foreach ($required_fields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                error_log("Missing required field: $field");
                echo 0;
                exit;
            }
        }

        $name = mysqli_real_escape_string($GLOBALS['con'], $_POST['name']);
        $area = filter_var($_POST['area'], FILTER_VALIDATE_INT);
        $price = filter_var($_POST['price'], FILTER_VALIDATE_INT);
        $quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
        $adult = filter_var($_POST['adult'], FILTER_VALIDATE_INT);
        $children = filter_var($_POST['children'], FILTER_VALIDATE_INT);
        $desc = mysqli_real_escape_string($GLOBALS['con'], $_POST['desc']);

        $features = json_decode($_POST['features']);
        $facilities = json_decode($_POST['facilities']);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo 0;
            exit;
        }

        if (!$area || !$price || !$quantity || !$adult || !$children) {
            echo 0;
            exit;
        }

        $q = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) 
              VALUES (?,?,?,?,?,?,?)";
        $values = [$name, $area, $price, $quantity, $adult, $children, $desc];

        if (insert($q, $values, 'siiiiis')) {
            $room_id = $GLOBALS['con']->insert_id;

            // Insert features
            $q_feature = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";
            foreach ($features as $f) {
                $f = filter_var($f, FILTER_VALIDATE_INT);
                if ($f) {
                    $values = [$room_id, $f];
                    insert($q_feature, $values, 'ii');
                }
            }

            // Insert facilities
            $q_facility = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";
            foreach ($facilities as $f) {
                $f = filter_var($f, FILTER_VALIDATE_INT);
                if ($f) {
                    $values = [$room_id, $f];
                    insert($q_facility, $values, 'ii');
                }
            }

            echo 1;
        } else {
            echo 0;
        }
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin-Rooms</title>
    <?php require ('inc/links.php');?>
</head>
<body class="bg-light">
<?php require('inc/header.php');?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">Rooms</h3>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="text-end mb-4">
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>
                    <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                            <thead class="sticky-top">
                            <tr class="bg-dark text-light">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Area</th>
                                <th scope="col">Guests</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="room-data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Add room Modal -->
<div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add_room_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Room</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control shadow-none" autocomplete="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="area">Area</label>
                            <input type="number" min="1" id="area" name="area" class="form-control shadow-none" autocomplete="area" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="price">Price</label>
                            <input type="number" min="1" id="price" name="price" class="form-control shadow-none" autocomplete="price" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="quantity">Quantity</label>
                            <input type="number" min="1" id="quantity" name="quantity" class="form-control shadow-none" autocomplete="quantity" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="adult">Adult (Max.)</label>
                            <input type="number" min="1" id="adult" name="adult" class="form-control shadow-none" autocomplete="adult" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="children">Children (Max.)</label>
                            <input type="number" min="1" id="children" name="children" class="form-control shadow-none" autocomplete="children" required>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Features</label>
                        <div class="row">
                            <?php
                            $res = selectAll('features');
                            while($opt = mysqli_fetch_assoc($res)){
                                echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                $opt[name]
                                            </label>
                                        </div>
                                        ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Facilities</label>
                        <div class="row">
                            <?php
                            $res = selectAll('facilities');
                            while($opt = mysqli_fetch_assoc($res)){
                                echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                $opt[name]
                                            </label>
                                        </div>
                                        ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold" for="description">Description</label>
                        <textarea id="desc" name="desc" rows="4" class="form-control shadow-none" autocomplete="desc" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_room" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>

            </div>
        </form>
    </div>
</div>


<!-- Edit room Modal -->
<div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="add_room_form" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Room</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control shadow-none" autocomplete="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="area">Area</label>
                            <input type="number" min="1" id="area" name="area" class="form-control shadow-none" autocomplete="area" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="price">Price</label>
                            <input type="number" min="1" id="price" name="price" class="form-control shadow-none" autocomplete="price" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="quantity">Quantity</label>
                            <input type="number" min="1" id="quantity" name="quantity" class="form-control shadow-none" autocomplete="quantity" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="adult">Adult (Max.)</label>
                            <input type="number" min="1" id="adult" name="adult" class="form-control shadow-none" autocomplete="adult" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="children">Children (Max.)</label>
                            <input type="number" min="1" id="children" name="children" class="form-control shadow-none" autocomplete="children" required>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Features</label>
                        <div class="row">
                            <?php
                            $res = selectAll('features');
                            while($opt = mysqli_fetch_assoc($res)){
                                echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                $opt[name]
                                            </label>
                                        </div>
                                        ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Facilities</label>
                        <div class="row">
                            <?php
                            $res = selectAll('facilities');
                            while($opt = mysqli_fetch_assoc($res)){
                                echo "
                                        <div class='col-md-3 mb-1'>
                                            <label>
                                                <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                $opt[name]
                                            </label>
                                        </div>
                                        ";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold" for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="form-control shadow-none" autocomplete="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="add_room" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>

            </div>
        </form>
    </div>
</div>


<?php require ('inc/scripts.php'); ?>
<script>
    let add_room_form = document.getElementById('add_room_form');

    function alert(type, msg) {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show custom-alert" role="alert">
                <strong>${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        document.body.append(element);
        setTimeout(() => element.remove(), 2000);
    }

    add_room_form.addEventListener('submit', function(e) {
        e.preventDefault();
        add_room();
    });


    function add_room(){
        let data = new FormData(add_room_form);
        data.append('action', 'add_room');
        data.append('csrf_token', '<?php echo $_SESSION['csrf_token']; ?>');

        let features = [];
        let facilities = [];

        document.querySelectorAll('input[name="features"]:checked').forEach(el => {
            features.push(el.value);
        });

        document.querySelectorAll('input[name="facilities"]:checked').forEach(el => {
            facilities.push(el.value);
        });

        data.append('features', JSON.stringify(features));
        data.append('facilities', JSON.stringify(facilities));

        // Kiểm tra dữ liệu trước khi gửi
        for (let pair of data.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);

        xhr.onload = function() {
            // Thêm log để xem response từ server
            console.log("Server response:", this.responseText);

            var myModal = document.getElementById('add-room');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == 1) {
                alert('success', 'Đã thêm phòng mới!');
                add_room_form.reset();
                get_all_rooms();
            } else {
                alert('error', 'Thêm phòng thất bại!');
            }
        }

        xhr.onerror = function() {
            alert('error', 'Có lỗi xảy ra khi kết nối với server!');
        }

        xhr.send(data);
    }

    function get_all_rooms(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            document.getElementById('room-data').innerHTML = this.responseText;
        }

        xhr.onerror = function() {
            alert('error', 'Có lỗi xảy ra khi tải dữ liệu!');
        }

        xhr.send('get_all_rooms=1&csrf_token=<?php echo $_SESSION['csrf_token']; ?>');
    }

    function toggle_status(id,val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function () {
           if(this.responseText==1){
               alert('success','Status toggled!');
               get_all_rooms();
           }
           else{
               alert('success','Server Down!');
           }
        }
        xhr.send('toggle_status='+id+'&value='+val+'&csrf_token=<?php echo $_SESSION['csrf_token']; ?>');
    }

    window.onload = function (){
        get_all_rooms();
    }
</script>

</body>
</html>