<?php
    function adminLogin()
    {
        session_start();
        if(!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] != true){
            // Nếu chưa đăng nhập thì chuyển về trang login
            echo"
            <script>
                window.location.href='index.php';
            </script>";
        }
        session_regenerate_id(true);//Tạo id mới và xóa id cũ
    }
    function redirect($url) {
        echo"
        <script>
        window.location.href='$url';
        </script>";
    }

    function alert($type, $msg){
        //Ktra $type là "success" thì class "alert-success",ko thì "alert-danger"
        $bs_class = ($type == "success") ? $alert = "alert-success" : $alert = "alert-danger";
        // Sử dụng heredoc để tạo chuỗi HTML
        echo <<<alert
           <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
           <strong class="me-3">$msg</strong>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>
        alert;
    }

?>
