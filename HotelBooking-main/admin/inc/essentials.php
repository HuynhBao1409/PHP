<?php

    //frontend
    define('SITE_URL','http://127.0.0.1/HotelBooking-main/');
    define('ABOUT_IMG_PATH', SITE_URL. 'images/about/');


    //backend


    // Lưu ý đường link dẫn file ảnh
    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/HotelBooking-main/images/');
    define('ABOUT_FOLDER','about/');

    function adminLogin()
    {
        session_start();
        if(!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] != true){
            // Nếu chưa đăng nhập thì chuyển về trang login
            echo"
            <script>
                window.location.href='index.php';
            </script>";
            exit;
        }
    }
    function redirect($url) {
        echo"
        <script>
        window.location.href='$url';
        </script>";
        exit;
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

    function uploadImage($image, $folder)
{
    // Tạo đường dẫn đầy đủ đến thư mục
    $target_dir = UPLOAD_IMAGE_PATH.$folder;

    // Kiểm tra và tạo thư mục nếu không tồn tại
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    }
    else if (($image['size']/(1024*1024)) > 2) {
        return 'inv_size';
    }
    else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(11111,99999).".".$ext;

        $img_path = $target_dir.$rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        }
        else {
            return 'upd_failed';
        }
    }
}

    function deleteImage($image, $folder)
    {
       if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
           return true;
       }
       else{
        return false;
       }
    }

?>
