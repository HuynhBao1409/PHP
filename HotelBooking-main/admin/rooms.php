<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require ('inc/essentials.php');
require ('inc/db_config.php');
adminLogin();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['seen_all'])) {
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if(update($q,$values,'i')){
            alert('success','Marked all as read');
        }
        else{
            alert('error','Operation Failed');
        }
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    if(isset($_POST['seen_single'])) {
        $sr_no = $_POST['sr_no'];
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1,$sr_no];
        if(update($q,$values,'ii')){
            alert('success','Marked as read');
        }
        else{
            alert('error','Operation Failed');
        }
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    if(isset($_POST['delete_all'])) {
        $con =$GLOBALS['con'];
        $q = "DELETE FROM `user_queries`";
        if(mysqli_query($con,$q)){
            alert('success','Đã xóa tất cả');
        }
        else{
            alert('error','Xóa thất bại');
        }
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

    if(isset($_POST['delete_single'])) {
        $sr_no = $_POST['sr_no'];
        if(is_numeric($sr_no)) {
            $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
            $values = [$sr_no];
            if(delete($q,$values,'i')){
                alert('success','Đã xóa');
            }
            else{
                alert('error','Xóa thất bại');
            }
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }
    }

    if(isset($_POST['action']) && $_POST['action'] == 'add_room') {
        $name = $_POST['name'];
        $area = $_POST['area'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $adult = $_POST['adult'];
        $children = $_POST['children'];
        $description = $_POST['description'];
        $features = json_decode($_POST['features']);
        $facilities = json_decode($_POST['facilities']);

        $q = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
        $values = [$name, $area, $price, $quantity, $adult, $children, $description];
        if(insert($q, $values, 'siiiiis')){
            $room_id = $GLOBALS['con']->insert_id;

            foreach($features as $f){
                $data = [
                    'room_id' => $room_id,
                    'feature_id' => $f
                ];
                insert('room_features', $data, 'ii');
            }

            foreach($facilities as $f){
                $data = [
                    'room_id' => $room_id,
                    'facility_id' => $f
                ];
                insert('room_facilities', $data, 'ii');
            }

            echo 1;
        }
        else{
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
    add_room_form.addEventListener('submit',function (e){
        e.preventDefault();
        add_room();
    });

    function add_room(){
        let data = new FormData(add_room_form);
        data.append('action', 'add_room');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);

        xhr.onload = function () {
            var myModal = document.getElementById('add-room');
            var modal = bootstrap.Modal.getInstance(myModal);
            modal.hide();

            if (this.responseText == 1) {
                alert('success', 'Đã thêm phòng mới!');
                add_room_form.reset();
                get_all_rooms();
            }
            else {
                alert('error', 'Thêm phòng thất bại!');
            }
        }
        xhr.send(data);
    }

    function get_all_rooms(){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);

        xhr.onload = function () {
            document.getElementById('room-data').innerHTML = this.responseText;
        }
        xhr.send('get_all_rooms');
    }

    function toggle_status(id,val){
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/rooms.php", true);

        xhr.onload = function () {
           if(this.responseText==1){
               alert('success','Status toggled!');
               get_all_rooms();
           }
           else{
               alert('success','Server Down!');
           }
        }
        xhr.send('toggle_status='+id+'$value='+val);
    }

    window.onload = function (){
        get_all_rooms();
    }
</script>

</body>
</html>