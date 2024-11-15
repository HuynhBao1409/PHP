<?php
require ('admin/inc/db_config.php');
require ('admin/inc/essentials.php');

?>
<!--Header-->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-lg-3 px-lg-2 shadow-sm ssticky-top">
    <div class="container-fluid">
        <a class="navbar-brand mx-2 fw-bold fs-3 h-font" href="index.php">HOTEL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active mx-2" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="about.php">About</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                session_start();
                include 'config.php';

                if (isset($_SESSION['user_role'])) {
                    echo '<p class="my-auto me-2">Xin chào, ' . $_SESSION['user_name'] . '!</p>';
                    if ($_SESSION['user_role'] == 'user') {
                        echo '<a href="logout.php" class="btn btn-outline-primary shadow-none mx-lg-3 mx-3">Logout</a>';
                    } else if ($_SESSION['user_role'] == 'admin') {
                        echo '<a href="admin/dashboard.php" class="btn btn-outline-primary shadow-none mx-lg-3 mx-3">Admin Dashboard</a>';
                        echo '<a href="logout.php" class="btn btn-outline-primary shadow-none mx-lg-3 mx-3">Logout</a>';
                    }
                } else {
                    echo '<button type="button" class="btn btn-outline-dark shadow-none mx-lg-3 mx-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>';
                    echo '<button type="button" class="btn btn-outline-primary shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>';
                }
                ?>
            </div>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="login.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i> Đăng nhập
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control shadow-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control shadow-none" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" name="login" class="btn btn-dark shadow-none">ĐĂNG NHẬP</button>
                        <button type="button" class="btn text-secondary text-decoration-none shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">
                            ĐĂNG KÝ
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="register.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center">
                        <i class="bi bi-person-lines-fill fs-3 me-2"></i> Đăng ký
                    </h5>
                    <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="cpassword" class="form-control shadow-none" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Vai trò</label>
                                <select class="form-select shadow-none" name="role" required>
                                    <option value="user">Khách hàng</option>
                                    <option value="admin">Quản trị viên</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="register" class="btn btn-dark shadow-none">ĐĂNG KÝ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>