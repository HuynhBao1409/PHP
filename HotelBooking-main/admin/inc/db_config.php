<?php
    //Connect SQL
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'hbwebsite';
    $con = mysqli_connect($hname, $uname, $pass, $db);

    if(!$con){
        die("Cannot Connect to Database".mysqli_connect_error());
    }
    //Bảo mật dữ liệu đầu vào
    function filteration($data){
        foreach ($data as $key => $value) {
            $data[$key] = trim($value); //trim() xóa khoảng trắng ở đầu và cuối chuỗi
            $data[$key] = stripslashes($value); //stripslashes xóa dấu gạch chéo
            $data[$key] = htmlspecialchars($value); //chuyển ký tự đặc biệt thành html
            $data[$key] = strip_tags($value); //bỏ thẻ html,php khỏi chuỗi
        }
        return $data;
    }

    function select($sql,$values,$datatypes){
        $con =$GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
            mysqli_stmt_bind_param($stmt, $datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
            else{
                mysqli_stmt_close($stmt);
                die("Query cannot be executed -Select");
            }

        }
        else{
            die("Query cannot be prepared -Select");
        }
    }
?>
