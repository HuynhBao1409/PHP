<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $role = $_POST['role'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Email đã tồn tại.')</script>";
            header('Location: index.php');
            exit();
        } else {
            if ($password == $cpassword) {

                $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('Đăng ký thành công.')</script>";
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<script>alert('Đăng ký thất bại.')</script>";
                    header('Location: index.php');
                    exit();
                }
            } else {
                echo "<script>alert('Mật khẩu không khớp.')</script>";
                header('Location: index.php');
                exit();
            }
        }
    }
}
?>