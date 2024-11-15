<div class="container-flud bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">HOTEL BOOKING WEBSITE</h3>
    <?php
    // Lấy thông tin admin từ database
    $admin_sql = "SELECT `admin_name`, `admin_pass`, `c_vu` FROM `admin_cred` WHERE 1";
    $admin_result = mysqli_query($con, $admin_sql);
    $admin_row = mysqli_fetch_assoc($admin_result);
    $ad_name = $admin_row['admin_name'];
    $c_vu = $admin_row['c_vu'];
    ?>
    <span class="me-3 text-light">Xin chào, <?php echo $ad_name; ?> (<?php echo $c_vu; ?>)</span>
    <a href="logout.php" class="btn btn-light btn-sm">LogOut</a>
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
                        <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="rooms.php">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="features_facilities.php">Features & Facilities</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>