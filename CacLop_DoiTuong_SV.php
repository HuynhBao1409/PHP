<?php
abstract class Nguoi {
    protected $hoTen;
    protected $diaChi;
    protected $gioiTinh;

    public function __construct($hoTen, $diaChi, $gioiTinh) {
        $this->hoTen = $hoTen;
        $this->diaChi = $diaChi;
        $this->gioiTinh = $gioiTinh;
    }

    public function getHoTen() {
        return $this->hoTen;
    }

    public function getDiaChi() {
        return $this->diaChi;
    }

    public function getGioiTinh() {
        return $this->gioiTinh;
    }
}

class SinhVien extends Nguoi {
    private $lopHoc;
    private $nganhHoc;

    public function __construct($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc) {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->lopHoc = $lopHoc;
        $this->nganhHoc = $nganhHoc;
    }

    public function tinhDiemThuong() {
        switch ($this->nganhHoc) {
            case 'CNTT':
                return 1;
            case 'Kinh tế':
                return 1.5;
            default:
                return 0;
        }
    }

    public function getLopHoc() {
        return $this->lopHoc;
    }

    public function getNganhHoc() {
        return $this->nganhHoc;
    }
}

class GiangVien extends Nguoi {
    private $trinhDo;
    const LUONG_CO_BAN = 1500000;

    public function __construct($hoTen, $diaChi, $gioiTinh, $trinhDo) {
        parent::__construct($hoTen, $diaChi, $gioiTinh);
        $this->trinhDo = $trinhDo;
    }

    public function tinhLuong() {
        switch ($this->trinhDo) {
            case 'Cử nhân':
                return self::LUONG_CO_BAN * 2.34;
            case 'Thạc sĩ':
                return self::LUONG_CO_BAN * 3.67;
            case 'Tiến sĩ':
                return self::LUONG_CO_BAN * 5.66;
            default:
                return self::LUONG_CO_BAN;
        }
    }

    public function getTrinhDo() {
        return $this->trinhDo;
    }
}

$result = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['hoTen'];
    $diaChi = $_POST['diaChi'];
    $gioiTinh = $_POST['gioiTinh'];
    $loai = $_POST['loai'];

    if ($loai == 'SinhVien') {
        $lopHoc = $_POST['lopHoc'];
        $nganhHoc = $_POST['nganhHoc'];
        $person = new SinhVien($hoTen, $diaChi, $gioiTinh, $lopHoc, $nganhHoc);
        $result = "Sinh viên: " . $person->getHoTen() . "<br>" .
                  "Địa chỉ: " . $person->getDiaChi() . "<br>" .
                  "Giới tính: " . $person->getGioiTinh() . "<br>" .
                  "Lớp học: " . $person->getLopHoc() . "<br>" .
                  "Ngành học: " . $person->getNganhHoc() . "<br>" .
                  "Điểm thưởng: " . $person->tinhDiemThuong();
    } else {
        $trinhDo = $_POST['trinhDo'];
        $person = new GiangVien($hoTen, $diaChi, $gioiTinh, $trinhDo);
        $result = "Giảng viên: " . $person->getHoTen() . "<br>" .
                  "Địa chỉ: " . $person->getDiaChi() . "<br>" .
                  "Giới tính: " . $person->getGioiTinh() . "<br>" .
                  "Trình độ: " . $person->getTrinhDo() . "<br>" .
                  "Lương: " . number_format($person->tinhLuong(), 0, ',', '.') . " VND";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên và Giảng viên</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        form { max-width: 500px; margin: 0 auto; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; margin-bottom: 10px; }
        input[type="submit"] { background-color: #4CAF50; color: white; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
        #result { margin-top: 20px; padding: 10px; background-color: #f0f0f0; border-radius: 5px; }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="hoTen">Họ tên:</label>
        <input type="text" id="hoTen" name="hoTen" required>

        <label for="diaChi">Địa chỉ:</label>
        <input type="text" id="diaChi" name="diaChi" required>

        <label for="gioiTinh">Giới tính:</label>
        <select id="gioiTinh" name="gioiTinh" required>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>

        <label for="loai">Loại:</label>
        <select id="loai" name="loai" required onchange="showFields()">
            <option value="SinhVien">Sinh viên</option>
            <option value="GiangVien">Giảng viên</option>
        </select>

        <div id="sinhVienFields">
            <label for="lopHoc">Lớp học:</label>
            <input type="text" id="lopHoc" name="lopHoc">

            <label for="nganhHoc">Ngành học:</label>
            <select id="nganhHoc" name="nganhHoc">
                <option value="CNTT">CNTT</option>
                <option value="Kinh tế">Kinh tế</option>
                <option value="Khác">Khác</option>
            </select>
        </div>

        <div id="giangVienFields" style="display: none;">
            <label for="trinhDo">Trình độ:</label>
            <select id="trinhDo" name="trinhDo">
                <option value="Cử nhân">Cử nhân</option>
                <option value="Thạc sĩ">Thạc sĩ</option>
                <option value="Tiến sĩ">Tiến sĩ</option>
            </select>
        </div>

        <input type="submit" value="Gửi">
    </form>

    <div id="result">
        <?php echo $result; ?>
    </div>

    <script>
        function showFields() {
            var loai = document.getElementById("loai").value;
            document.getElementById("sinhVienFields").style.display = loai === "SinhVien" ? "block" : "none";
            document.getElementById("giangVienFields").style.display = loai === "GiangVien" ? "block" : "none";
        }
    </script>
</body>
</html>