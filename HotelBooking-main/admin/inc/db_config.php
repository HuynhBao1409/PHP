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
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
        $data[$key] = $value; // Gán giá trị đã xử lý vào mảng
    }
    return $data;
}

function selectAll($table) {
    $con = $GLOBALS['con'];
    $res = mysqli_query($con, "SELECT * FROM $table");
    if (!$res) {
        die("Query failed: " . mysqli_error($con));
    }
    return $res;
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

function update($sql,$values,$datatypes){
    $con =$GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt, $datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed -Update");
        }

    }
    else{
        die("Query cannot be prepared -Update");
    }
}

function insert($sql,$values,$datatypes) {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes,...$values);
        if(mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            error_log("MySQL Error: " . mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
            return "Query cannot be executed - Insert: " . mysqli_stmt_error($stmt);
        }
    } else {
        error_log("MySQL Prepare Error: " . mysqli_error($con));
        return "Query cannot be prepared - Insert: " . mysqli_error($con);
    }
}

function delete($sql,$values,$datatypes){
    $con =$GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt, $datatypes,...$values);
        if(mysqli_stmt_execute($stmt)){
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed -Delete");
        }

    }
    else{
        die("Query cannot be prepared -Delete");
    }
}

// Đăng ký tài khoản
function registerUser($name, $email, $password, $role) {
    global $con;

    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Kiểm tra email đã tồn tại chưa
    $check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $check_email);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        return "Email đã được đăng ký.";
    } else {
        // Thêm tài khoản mới vào database
        $insert_sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $insert_sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashed_password, $role);

        if (mysqli_stmt_execute($stmt)) {
            // Nếu role là 'admin', thêm vào bảng admin_cred
            if ($role == 'admin') {
                $insert_admin_sql = "INSERT INTO admin_cred (admin_name, admin_pass, c_vu) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($con, $insert_admin_sql);
                mysqli_stmt_bind_param($stmt, "sss", $name, $hashed_password, $role);
                mysqli_stmt_execute($stmt);
            }
            return "Đăng ký thành công.";
        } else {
            return "Lỗi khi đăng ký tài khoản.";
        }
    }

    mysqli_stmt_close($stmt);
}

?>
