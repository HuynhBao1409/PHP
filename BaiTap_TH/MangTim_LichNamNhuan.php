<?php
function nam_nhuan($nam) {
    return ($nam % 400 == 0) || ($nam % 4 == 0 && $nam % 100 != 0);
}

$ket_qua = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nam = isset($_POST['nam']) ? intval($_POST['nam']) : 0;
    
    if ($nam < 2000) {
        $nam_nhuan = [];
        for ($year = 2000; $year >= $nam; $year -= 4) {
            if (nam_nhuan($year)) {
                $nam_nhuan[] = $year;
            }
        }
        $ket_qua = implode(' ', array_reverse($nam_nhuan)) . ' là năm nhuận';
    } elseif ($nam > 2000) {
        $nam_nhuan = [];
        for ($year = 2000; $year <= $nam; $year += 4) {
            if (nam_nhuan($year)) {
                $nam_nhuan[] = $year;
            }
        }
        $ket_qua = implode(' ', $nam_nhuan) . ' là năm nhuận';
    } else {
        $ket_qua = '2000 là năm nhuận';
    }

    if (empty($nam_nhuan)) {
        $ket_qua = "Không có năm nhuận";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Năm Nhuận</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background-color: #f0f0f0; padding: 20px; border-radius: 5px; }
        h1 { color: white; background-color: #FF3333; padding: 10px; text-align: center; }
        form { margin-bottom: 20px; }
        input[type="number"] { padding: 5px; width: 100%; }
        input[type="submit"] { padding: 10px 40px; background-color: #FF3333; color: white; border: none; cursor: pointer; display: flex;margin: 0 34%;font-size:15px; }
        .ket-qua { background-color: #e0e0e0; padding: 10px; border-radius: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>TÌM NĂM NHUẬN</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nam">Năm:</label><br>
            <input type="number" id="nam" name="nam" required><br><br>
            <input type="submit" value="Tìm năm nhuận">
        </form>

        <?php if (!empty($ket_qua)): ?>
            <div class="ket-qua" style="text-align: center;">
                <strong>Kết quả:</strong> <?php echo $ket_qua; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>