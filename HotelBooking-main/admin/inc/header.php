<div class="container-flud bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">HOTEL BOOKING WEBSITE</h3>
    <?php
    // Lấy thông tin quản trị viên từ cơ sở dữ liệu
    require_once 'db_config.php';

    // Đảm bảo session đã được start
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['adminName'])) {
        // Sử dụng Prepared Statement để tránh SQL injection
        $admin_sql = "SELECT `admin_name`, `admin_pass`, `c_vu` FROM `admin_cred` WHERE `admin_name` = ?";
        $stmt = mysqli_prepare($con, $admin_sql);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['adminName']);
        mysqli_stmt_execute($stmt);
        $admin_result = mysqli_stmt_get_result($stmt);
        $admin_row = mysqli_fetch_assoc($admin_result);

        if ($admin_row) {
            $ad_name = $admin_row['admin_name'];
            $c_vu = $admin_row['c_vu'];

            // Hiển thị chào mừng dựa trên chức vụ của quản trị viên
            if ($c_vu == 'giamdoc') {
                $greeting = "Xin chào, $ad_name ( Giám đốc )";
            } else {
                $greeting = "Xin chào, $ad_name ( Nhân viên )";
            }
        }
    }
    ?>
    <span class="me-3 text-light"><?php echo isset($greeting) ? $greeting : "Chưa đăng nhập"; ?></span>
    <div class="d-flex justify-content-end">
        <?php if (isset($c_vu) && $c_vu == 'giamdoc'): ?>
            <button type="button" class="btn btn-light btn-sm me-3" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-light btn-sm">LogOut</a>
    </div>
</div>

<div class="col-lg-2 bg-dark border-top border-3 border-secondary position-fixed h-100" id="dashboard-menu">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="mt-2 text-light">ADMIN PANEL</h4>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-strech mt-2" id="adminDropdown">
                <ul class="nav nav-pills flex-column w-100">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard.php">Trang chủ</a>
                    </li>
                    <?php if (isset($c_vu) && $c_vu == 'giamdoc'): ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="rooms.php">Loại phòng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="features_facilities.php">Đặc trưng và Tiện ích</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="users.php">Tài khoản</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>

<?php if (isset($c_vu) && $c_vu == 'giamdoc'): ?>
    <!-- Form đăng ký - Chỉ hiển thị cho giám đốc -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Đăng ký tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="registerName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerRole" class="form-label">Chức vụ</label>
                            <select class="form-select" id="registerRole" name="role" required>
                                <option value="nhanvien">Nhân viên</option>
                                <option value="giamdoc">Giám đốc</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>