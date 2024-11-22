<?php
require('inc/essentials.php');
require('inc/db_config.php');

session_start();
// Kiểm tra xem admin đã đăng nhập chưa
if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true)) {
    redirect("index.php");
}

// Lấy thông tin admin từ database
$admin_sql = "SELECT `admin_name`, `c_vu` FROM `admin_cred` WHERE `sr_no`=?";
$admin_values = [$_SESSION['adminId']];
$admin_res = select($admin_sql, $admin_values, "i");
$admin_row = mysqli_fetch_assoc($admin_res);
$ad_name = $admin_row['admin_name'];
$c_vu = $admin_row['c_vu'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <?php require('inc/links.php'); ?>
    <style>
        #dashboard-menu {
            background-color: #343a40;
            border-top: 3px solid #dee2e6;
        }

        #dashboard-menu a {
            color: #fff;
            text-decoration: none;
        }

        #dashboard-menu a:hover {
            color: #007bff;
        }
    </style>
</head>
<body class="bg-light">

<?php require('inc/header.php'); ?>

<div class="container-fluid" id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị ?>
            <?php endif; ?>
            <div class="d-flex align-itmes-center justify-content-between mb-4">
                <h3>Trang chủ</h3>

            </div>

            <div class="row m-4">
                <div class="col-md-3 mb-4">
                    <a href="new_booking.php" class="text-decoration-none">
                        <div class="card text-center text-success p3">
                            <h6>New Booking</h6>
                            <h1 class="mt-2 mb-0">5</h1>

                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="refund_booking.php" class="text-decoration-none">
                        <div class="card text-center text-warning p3">
                            <h6>Refund Booking</h6>
                            <h1 class="mt-2 mb-0">4</h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="user_queries.php" class="text-decoration-none">
                        <div class="card text-center text-info p3">
                            <h6>User Booking</h6>
                            <h1 class="mt-2 mb-0">4</h1>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 mb-4">
                    <a href="rate_review.php" class="text-decoration-none">
                        <div class="card text-center text-info p3">
                            <h6>Rating & Review</h6>
                            <h1 class="mt-2 mb-0">4</h1>
                        </div>
                    </a>
                </div>
            </div>


            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>Booking Analytics</h5>
                <select class="form-select shadow-none bg-light w-auto">
                    <option value="1">Past 30 Days</option>
                    <option value="2">Past 90 Days</option>
                    <option value="3">Past 1 Year</option>
                    <option value="4">All time</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p3">
                        <h6>Total Booking</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                        <h4 class="mt-2 mb-0">VND 0</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p3">
                        <h6>Active Booking</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                        <h4 class="mt-2 mb-0">VND 0</h4>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p3">
                        <h6>Cancelled Booking</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                        <h4 class="mt-2 mb-0">VND 0</h4>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5>User, Queries, Review Analytics</h5>
                <select class="form-select shadow-none bg-light w-auto">
                    <option value="1">Past 30 Days</option>
                    <option value="2">Past 90 Days</option>
                    <option value="3">Past 1 Year</option>
                    <option value="4">All time</option>
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p3">
                        <h6>New Registration</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p3">
                        <h6>Queries</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-primary p3">
                        <h6>Reviews</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
            </div>

            <h5>Users</h5>
            <div class="row mb-3">
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-info p3">
                        <h6>Total</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-success p3">
                        <h6>Active</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-warning p3">
                        <h6>Inactive</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card text-center text-danger p3">
                        <h6>Unverified</h6>
                        <h1 class="mt-2 mb-0">0</h1>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require ('inc/scripts.php'); ?>
</body>
</html>