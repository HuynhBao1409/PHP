<?php
    require ('inc/essentials.php');
    require ('inc/db_config.php');

    session_start();
    if(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] != true){
        redirect("dashboard.php");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <?php require ('inc/links.php'); ?>
    <style>
        div.login-form{
            position: absolute;
            top:50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 400px;
        }
    </style>
</head>
<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST" >
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN</h4>
            <div class="p-4">
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none text-center" placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <div class="input-group">
                        <input name="admin_pass" required type="password" class="form-control shadow-none text-center" placeholder="Password">
                        <button class="btn btn-outline-secondary d-none" type="button" id="togglePass">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>
                <button name="login" type="submit" class="btn text-white custom-bg shadow-none ">LOGIN</button>

            </div>
        </form>
    </div>

    <?php
    //Ktra đã submit chưa
        if(isset($_POST['login']))
        {
            $frm_data = filteration($_POST); //Lọc dữ liệu form

            //Lệnh truy vấn lấy dữ liệu từ bản admin_cred
            $query = "SELECT * FROM `admin_cred` WHERE `admin_name` = ? AND `admin_pass` = ?";
            $values = [$frm_data["admin_name"],$frm_data["admin_pass"]];

            $res = select($query,$values,"ss"); //"ss": 2 tham số kia đều là string
            if($res->num_rows ==1){
                $row= mysqli_fetch_array($res);
                $_SESSION['adminLogin'] = true; // Tạo session admin đã login
                $_SESSION['adminId'] = $row['sr_no'];
                redirect('dashboard.php'); //Chuyển hướng tới dashboard

            }else{
                alert('error','Login failed- Invalid Credentials!');
            }
        }
    ?>


    <?php require ('inc/scripts.php'); ?>
    <script>
        const togglePass = document.querySelector('#togglePass');
        const passInput = document.querySelector('input[name="admin_pass"]');

        // Hiện button toggle khi click vào input password
        passInput.addEventListener('focus', () => {
            togglePass.classList.remove('d-none');
        });

        // Toggle password visibility
        togglePass.addEventListener('click', () => {
            const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passInput.setAttribute('type', type);

            togglePass.querySelector('i').classList.toggle('bi-eye');
            togglePass.querySelector('i').classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
