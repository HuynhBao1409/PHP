<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel-ROOMS_Details</title>
    <?php require ('inc/links.php');?>
    <style>
        .pop:hover{
            border-top-color: #2ec1ac !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }
    </style>
</head>
<body class="bg-light">
<!--Header-->
<?php require ('inc/header.php'); ?>

<?php
if(!isset($_GET['id'])){
    redirect("rooms.php");
}
$data = filteration($_GET);
$room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=?", [$data['id'],1], 'ii');
if(mysqli_num_rows($room_res) == 0){
    redirect('rooms.php');
}
$room_data = mysqli_fetch_assoc($room_res);
?>

<div class="container">
    <div class="row">
        <div class="col-12 my-5 mb-4 px-4">
            <h2 class="fw-bold"><?php echo $room_data['name']?></h2>
            <hr class="w-50 mx-auto">
            <div style="font-size: 14px">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary">>></span>
                <a href="rooms.php" class="text-secondary text-decoration-none">ROOMS</a>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 px-4">
            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $room_img = ROOMS_IMG_PATH."thumbnail.jpg";
                    $img_q = mysqli_query($con, "SELECT * FROM `room_images` 
                                WHERE `room_id`='$room_data[id]'");

                    if(mysqli_num_rows($img_q)>0){
                        $active_class = 'active';
                        while($img_res = mysqli_fetch_assoc($img_q)){
                            echo "
                                        <div class='carousel-item $active_class'>
                                            <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                                        </div>
                                    ";
                            $active_class = '';
                        }
                    }
                    else{
                        echo "<div class='carousel-item active'>
                                    <img src='$room_img' class='d-block w-100'>
                                </div>";
                    }
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <?php
                    echo<<<price
                                <h4>$room_data[price] VNĐ/ngày</h4>
                            price;

                    echo<<<rating
                                <div class="mb-3">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </div>
                            rating;

                    // Get features
                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                                INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                                WHERE rfea.room_id = '$room_data[id]'");

                    $features_data = "";
                    while($fea_row = mysqli_fetch_assoc($fea_q)){
                        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fea_row[name]
                                </span>";
                    }

                    echo<<<features
                                <div class="mb-3">
                                    <h6 class="mb-1">Mô tả</h6>
                                    $features_data
                                </div>
                            features;

                    // Get facilities
                    $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
                                INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                                WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data = "";
                    while($fac_row = mysqli_fetch_assoc($fac_q)){
                        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                    $fac_row[name]
                                </span>";
                    }

                    echo<<<facilities
                                <div class="mb-3">
                                    <h6 class="mb-1">Cơ sở vật chất</h6>
                                    $facilities_data
                                </div>
                            facilities;

                    echo<<<guests
                                <div class="guests mb-3">
                                    <h6 class="mb-1">Số lượng khách</h6>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[adult] người lớn
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                                        $room_data[children] trẻ em
                                    </span>
                                </div>
                            guests;

                    echo <<<area
                        <div class="mb-3">
                            <h6 class="mb-1">Diện tích</h6>
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                $room_data[area] m²
                            </span>  
                        </div>     
                    area;

                    ?>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4 px-4">
            <div class="mb-4">
                <h5>Các phòng khác</h5>
            </div>
            <?php
            $other_rooms = select("SELECT * FROM `rooms` WHERE `id`!=? AND `status`=? LIMIT 3", [$room_data['id'],1], 'ii');

            while($other_room = mysqli_fetch_assoc($other_rooms)){
                // Get room thumbnail
                $room_thumb = ROOMS_IMG_PATH."thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
                            WHERE `room_id`='$other_room[id]' 
                            AND `thumb`='1'");

                if(mysqli_num_rows($thumb_q) > 0){
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
                }

                // Get features of other rooms
                $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
                            INNER JOIN `room_features` rfea ON f.id = rfea.features_id 
                            WHERE rfea.room_id = '$other_room[id]'");

                $features_data = "";
                while($fea_row = mysqli_fetch_assoc($fea_q)){
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                $fea_row[name]
                            </span>";
                }

                // Print room card
                echo <<<data
                            <div class="card mb-4 border-0 shadow">
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                        <img src="$room_thumb" class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-5 px-lg-3 px-0">
                                        <h5 class="mb-3">$other_room[name]</h5>
                                        <div class="features mb-3">
                                            <h6 class="mb-1">Mô tả</h6>
                                            $features_data
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-lg-0 mt-md-0 mt-4 text-center">
                                        <h6 class="mb-4">$other_room[price] VNĐ/ngày</h6>
                                        <a href="book.php?id=$other_room[id]" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Đặt phòng</a>
                                        <a href="room_details.php?id=$other_room[id]" class="btn btn-sm w-100 btn-outline-dark shadow-none">Thêm chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        data;
            }
            ?>
        </div>
    </div>
</div>

<!--Footer-->
<?php require ('inc/footer.php'); ?>
</body>
</html>