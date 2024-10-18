<?php
function taoMangNgauNhien($n) {
    $mang = [];
    for ($i = 0; $i < $n; $i++) {
        $mang[] = rand(-1000, 1000); // Số ngẫu nhiên từ -1000 đến 1000
    }
    return $mang;
}

function demSoChan($mang) {
    return count(array_filter($mang, function($so) {
        return $so % 2 == 0;
    }));
}

function demSoNhoHon100($mang) {
    return count(array_filter($mang, function($so) {
        return $so < 100;
    }));
}

function tongSoAm($mang) {
    return array_sum(array_filter($mang, function($so) {
        return $so < 0;
    }));
}

function timViTriChuSoKeCuoiLa0($mang) {
    $viTri = [];
    foreach ($mang as $index => $so) {
        if (abs($so) >= 10 && abs($so) % 100 >= 0 && abs($so) % 100 < 10) {
            $viTri[] = $index;
        }
    }
    return $viTri;
}

$ketQua = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $n = isset($_POST['n']) ? intval($_POST['n']) : 0;
    if ($n > 0) {
        $mang = taoMangNgauNhien($n);
        $ketQua['mang'] = $mang;
        $ketQua['soChan'] = demSoChan($mang);
        $ketQua['soNhoHon100'] = demSoNhoHon100($mang);
        $ketQua['tongSoAm'] = tongSoAm($mang);
        $ketQua['viTriChuSoKeCuoiLa0'] = timViTriChuSoKeCuoiLa0($mang);
        sort($mang);
        $ketQua['mangDaSapXep'] = $mang;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xử lý Mảng Ngẫu nhiên</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        form { margin-bottom: 20px; }
        input[type="number"] { padding: 5px; }
        input[type="submit"] { padding: 5px 10px; }
        .ketQua { background-color: #f4f4f4; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xử lý Mảng Ngẫu nhiên</h1>
        <form method="post">
            <label for="n">Nhập số phần tử của mảng (n):</label>
            <input type="number" id="n" name="n" required min="1">
            <input type="submit" value="Tạo và xử lý mảng">
        </form>

        <?php if (!empty($ketQua)): ?>
            <div class="ketQua">
                <h2>Kết quả:</h2>
                <p>a. Mảng phát sinh ngẫu nhiên:</p>
                <pre><?php print_r($ketQua['mang']); ?></pre>
                <p>b. Số phần tử chẵn: <?php echo $ketQua['soChan']; ?></p>
                <p>c. Số phần tử nhỏ hơn 100: <?php echo $ketQua['soNhoHon100']; ?></p>
                <p>d. Tổng các số âm: <?php echo $ketQua['tongSoAm']; ?></p>
                <p>e. Vị trí các phần tử có chữ số kề cuối là 0: <?php echo implode(', ', $ketQua['viTriChuSoKeCuoiLa0']); ?></p>
                <p>f. Mảng sau khi sắp xếp tăng dần:</p>
                <pre><?php print_r($ketQua['mangDaSapXep']); ?></pre>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>