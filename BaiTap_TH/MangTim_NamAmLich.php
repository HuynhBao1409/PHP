<?php
$mang_can = array("Quý", "Giáp", "Ất", "Bính", "Đinh", "Mậu", "Kỷ", "Canh", "Tân", "Nhâm");
$mang_chi = array("Hợi", "Tý", "Sửu", "Dần", "Mão", "Thìn", "Tỵ", "Ngọ", "Mùi", "Thân", "Dậu", "Tuất");
$mang_hinh = array("hoi.jpg", "ty.jpg", "suu.jpg", "dan.jpg", "mao.jpg", "thin.jpg", "ty.jpg", "ngo.jpg", "mui.jpg", "than.jpg", "dau.jpg", "tuat.jpg");

$nam_am_lich = '';
$hinh_anh = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nam = isset($_POST['nam']) ? intval($_POST['nam']) : 0;
    
    if ($nam > 0) {
        $nam = $nam - 3;
        $can = $nam % 10;
        $chi = $nam % 12;
        $nam_al = $mang_can[$can] . " " . $mang_chi[$chi];
        $hinh = $mang_hinh[$chi];
        
        $nam_am_lich = $nam_al;
        $hinh_anh = "<img src='images/$hinh' alt='Con giáp' style='width:100px;height:100px; padding-left:13%'>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính Năm Âm Lịch</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        .container { max-width: 350px; margin: 0 auto; background-color: #f0f0f0; padding: 20px; border-radius: 5px; }
        h1 { color: white; background-color: #4a90e2; padding: 10px; text-align: center; }
        form { margin-bottom: 20px; }
        input[type="number"] { padding: 5px; width: 100%; }
        input[type="submit"] { padding: 5px 20px; background-color: #4a90e2; color: white; border: none; cursor: pointer;display: flex;margin: 0 40%;font-size:15px; }
        .ket-qua { background-color: #e0e0e0; padding: 10px; border-radius: 5px;display: flex; margin: center  }
    </style>
</head>
<body>
    <div class="container">
        <h1>TÍNH NĂM ÂM LỊCH</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nam">Năm dương lịch:</label><br>
            <input type="number" id="nam" name="nam" required><br><br>
            <input type="submit" value="Kêt quả">
        </form>

        <?php if (!empty($nam_am_lich)): ?>
            <div class="ket-qua">
                <p><strong>Năm âm lịch:</strong> <?php echo $nam_am_lich; ?></p>
                <?php echo $hinh_anh; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>