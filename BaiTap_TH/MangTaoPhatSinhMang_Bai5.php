<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phát sinh mảng và tính toán</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            animation: colorful 8s infinite;
            background-color: gray;
            padding: 10px;
            margin: -20px -20px 20px -20px;
            border-radius: 5px 5px 0 0;
            display: flex;
            justify-content: center;
        }
        input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: gray;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }
        .result {
            animation: rgb-flash 3s linear infinite;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            color: white;
            text-shadow: 1px 1px 2px black;
        }
        
        @keyframes colorful {
            0% {color: red;}
            10% {color: orange;}
            20% {color: yellow;} 
            30% {color: green;}
            40% {color: blue;}
            50% {color: indigo;}
            60% {color: violet;}
            70% {color: red;}
            80% {color: orange;}
            90% {color: yellow;}
            100% {color: green;}
        }

        @keyframes rgb-flash {
            0% {background-color: red;}
            33% {background-color: green;}
            66% {background-color: blue;}
            100% {background-color: red;}
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>PHÁT SINH MẢNG VÀ TÍNH TOÁN</h2>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="so_phan_tu">Nhập số phần tử:</label>
            <input type="number" id="so_phan_tu" name="so_phan_tu" required min="1" max="20">
            <input type="submit" value="Phát sinh và tính toán">
        </form>

        <?php
        function tao_mang($n) {
            $mang = array();
            for ($i = 0; $i < $n; $i++) {
                $mang[] = rand(0, 20);
            }
            return $mang;
        }

        function xuat_mang($mang) {
            return implode(' ', $mang);
        }

        function tinh_tong($mang) {
            return array_sum($mang);
        }

        function tim_max($mang) {
            return max($mang);
        }

        function tim_min($mang) {
            return min($mang);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $so_phan_tu = $_POST["so_phan_tu"];
            $mang = tao_mang($so_phan_tu);

            echo "<div class='result'>";
            echo "Mảng: " . xuat_mang($mang) . "<br>";
            echo "GTLN (MAX) trong mảng: " . tim_max($mang) . "<br>";
            echo "TTNN (MIN) trong mảng: " . tim_min($mang) . "<br>";
            echo "Tổng mảng: " . tinh_tong($mang) . "<br>";
            echo "</div>";
        }
        echo "<p><font color=red>*Ghi chú:</font> Các phần tử trong mảng có giá trị từ 0 đến 20</p>";
        ?>
    </div>
</body>
</html>