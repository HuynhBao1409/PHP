<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính tổng dãy số</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex; margin: 20px center
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            background-color: #e7f3fe;
            border: 1px solid #3498db;
            padding: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tính tổng dãy số</h2>
        <form action="Nhap_TinhCacDaySo.php" method="POST">
            <label for="dayso">Nhập dãy số (cách nhau bởi dấu phẩy):</label>
            <input type="text" id="dayso" name="dayso" required>
            <input type="submit" value="Tính tổng">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dayso = $_POST["dayso"];
            $mang = explode(",", $dayso);
            $tong = 0;
            $so_phan_tu = count($mang);

            foreach ($mang as $so) {
                $tong += (int)trim($so);
            }

            echo "<div class='result'>";
            echo "<h3>Kết quả:</h3>";
            echo "<p>Dãy số: " . $dayso . "</p>";
            echo "<p>Số phần tử: " . $so_phan_tu . "</p>";
            echo "<p>Tổng: " . $tong . "</p>";

            // Lưu dữ liệu vào file
            $filename = "dulieu_bai4.txt";
            $file = fopen($filename, "w");  
            fwrite($file, $dayso);
            fclose($file);
            echo "<p>Đã lưu dãy số vào {$filename}</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>