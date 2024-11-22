<?php
// Kết nối database
require('inc/db_config.php');

// Kiểm tra nếu form đăng ký được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $name = filteration($_POST['name']);
    $email = filteration($_POST['email']);
    $password = filteration($_POST['password']);
    $role = filteration($_POST['role']);

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra email đã tồn tại chưa
    $check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $check_email);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "Email đã được đăng ký.";
    } else {
        // Thêm tài khoản mới vào database
        $insert_sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $role);

        if (mysqli_stmt_execute($stmt)) {
            echo "Đăng ký thành công.";
        } else {
            echo "Lỗi khi đăng ký tài khoản.";
        }
    }

    mysqli_stmt_close($stmt);
}
?>

<!-- Form đăng ký -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Role:
    <select name="role" required>
        <option value="user">Nhân viên</option>
        <option value="admin">Giám đốc</option>
    </select><br>
    <input type="submit" name="submit" value="Đăng ký">
</form>