<?php
require('../inc/db_config.php');
require('../inc/essentials.php');

adminLogin();

if(isset($_POST['delete_user']))
{
    $id = $_POST['user_id'];

    // Kiểm tra xem user có phải là admin không
    $query = "SELECT * FROM users WHERE id = ? AND role = 'admin'";
    $values = [$id];
    $res = select($query, $values, 's');

    if(mysqli_num_rows($res) > 0) {
        echo 'admin'; // Không cho phép xóa tài khoản admin
        exit;
    }

    // Thực hiện xóa user
    $query = "DELETE FROM users WHERE id = ?";
    $values = [$id];

    if(delete($query, $values, 'i')) {
        echo 1;
    } else {
        echo 0;
    }
}

if(isset($_POST['get_user']))
{
    $id = $_POST['get_user'];

    $query = "SELECT * FROM users WHERE id = ?";
    $values = [$id];
    $res = select($query, $values, 'i');

    $data = mysqli_fetch_assoc($res);
    $json_data = json_encode($data);

    echo $json_data;
}

if(isset($_POST['edit_user']))
{
    $id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Kiểm tra email đã tồn tại chưa (trừ email hiện tại của user)
    $query = "SELECT * FROM users WHERE email = ? AND id != ?";
    $values = [$email, $id];
    $res = select($query, $values, 'si');

    if(mysqli_num_rows($res) > 0) {
        echo 'email_exists';
        exit;
    }

    // Cập nhật thông tin user
    $query = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
    $values = [$name, $email, $role, $id];

    if(update($query, $values, 'sssi')) {
        // Nếu role thay đổi thành admin, thêm vào bảng admin_cred
        if($role == 'admin') {
            $check_admin = select("SELECT * FROM admin_cred WHERE admin_name = ?", [$name], 's');
            if(mysqli_num_rows($check_admin) == 0) {
                $admin_pass = '123'; // Mật khẩu mặc định cho admin mới
                $insert_admin = "INSERT INTO admin_cred(admin_name, admin_pass, c_vu) VALUES (?, ?, 'nhanvien')";
                insert($insert_admin, [$name, $admin_pass], 'ss');
            }
        }
        // Nếu role thay đổi thành user, xóa khỏi bảng admin_cred
        else {
            $delete_admin = "DELETE FROM admin_cred WHERE admin_name = ?";
            delete($delete_admin, [$name], 's');
        }
        echo 1;
    } else {
        echo 0;
    }
}
?>