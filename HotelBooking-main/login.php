<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            $user_role = $row['role'];

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_role'] = $user_role;
                $_SESSION['message'] = "Đăng nhập thành công!";
                $_SESSION['message_type'] = "success";

                if ($user_role == 'admin') {
                    header("Location: admin/dashboard.php");
                    exit;
                } else {
                    header("Location: index.php");
                    exit;
                }
            } else {
                $_SESSION['message'] = "Sai email hoặc mật khẩu.";
                $_SESSION['message_type'] = "error";
                header("Location: index.php");
                exit;
            }
        } else {
            $_SESSION['message'] = "Sai email hoặc mật khẩu.";
            $_SESSION['message_type'] = "error";
            header("Location: index.php");
            exit;
        }
    }
}
?>
