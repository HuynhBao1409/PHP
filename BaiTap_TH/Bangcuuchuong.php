<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 20px;
        }
        h3 {
            text-align: center;
            color: grey;
        }
        .table-container {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .table {
            border: 1px solid #007bff;
            border-radius: 8px;
            overflow: hidden;
            background-color: #ffffff;
            margin: 10px; 
            width: 150px;
        }
        .table-header {
            background-color: grey;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .table-row {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
        }
        .table-row:last-child {
            border-bottom: none;
        }
        @media (max-width: 600px) {
            .table-row {
                padding: 8px;
            }
            .table {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>

    <h3>Bảng Cửu Chương</h3>
    
    <div class="table-container">
        <?php
        for ($n = 1; $n <= 10; $n++) {
            echo "<div class='table'>";
            echo "<div class='table-header'><strong>Bảng $n</strong></div>";
            
            for ($i = 1; $i <= 10; $i++) {
                $nhan = $i * $n;
                echo "<div class='table-row'>$i * $n = $nhan</div>";
            }
            
            echo "</div>";
        }
        ?>
    </div>

</body>
</html>