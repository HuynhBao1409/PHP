<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả xổ số Khánh Hòa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .xoso-table {
            width: 100%;
            max-width: 500px;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .xoso-table th, .xoso-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .xoso-table th {
            background-color: #f2f2f2;
        }
        .header {
            background-color: #ff0000;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .subheader {
            background-color: #f0f0f0;
            padding: 5px;
            text-align: center;
        }
        .subheader a {
            color: #0066cc;
            text-decoration: none;
        }
        .giai {
            font-weight: bold;
            color: #ff0000;
        }
        
        .number {
            font-weight: bold;
        }
        .db {
            color: #ff0000;
            font-size: 1.2em;
        }
        
    </style>
</head>
<body>
    <div class="header">XSKH - KẾT QUẢ XỔ SỐ KHÁNH HÒA - SXKH HÔM NAY</div>
    <table class="xoso-table">
        <tr>
            <td class="giai">G8</td>
            <td class="number" colspan="4"><?php echo sprintf("%02d", rand(0, 99)); ?></td>
        </tr>
        <tr>
            <td class="giai">G7</td>
            <th class="number" colspan="4"><?php echo sprintf("%03d", rand(0, 999)); ?></th>
        </tr>
        <tr>
            <td class="giai">G6</td>
            <td class="number"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
            <td class="number" colspan="2"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
            <td class="number"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
        </tr>
        <tr>
            <td class="giai">G5</td>
            <th class="number" colspan="4"><?php echo sprintf("%05d", rand(0, 99999)); ?></th>
        </tr>
        <tr>
            <td class="giai" rowspan="2">G4</td>
            <td class="number"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
            <td class="number"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
            <td class="number"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
            <td class="number"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
        </tr>
        <tr>
            <td class="number" colspan="2"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
            <td class="number" colspan="2"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
        </tr>
        <tr>
        <td class="giai">G3</td>
            <th class="number" colspan="2"><?php echo sprintf("%05d", rand(0, 99999)); ?></th>
            <th class="number" colspan="2"><?php echo sprintf("%05d", rand(0, 99999)); ?></th>
        </tr>
        <tr>
            <td class="giai">G2</td>
            <td class="number" colspan="4"><?php echo sprintf("%05d", rand(0, 99999)); ?></td>
        </tr>
        <tr>
            <td class="giai">G1</td>
            <th class="number" colspan="4"><?php echo sprintf("%05d", rand(0, 99999)); ?></th>
        </tr>
        <tr>
            <td class="giai">ĐB</td>
            <td class="number db" colspan="4"><?php echo sprintf("%06d", rand(0, 999999)); ?></td>
        </tr>
    </table>
</body>
</html>