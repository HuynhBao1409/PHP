<?php
abstract class NhanVien {
    protected $hoTen;
    protected $gioiTinh;
    protected $ngayVaoLam;
    protected $heSoLuong;
    protected $soCon;
    const LUONG_CO_BAN = 1500000; // Assuming a base salary of 1,500,000 VND

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon) {
        $this->hoTen = $hoTen;
        $this->gioiTinh = $gioiTinh;
        $this->ngayVaoLam = $ngayVaoLam;
        $this->heSoLuong = $heSoLuong;
        $this->soCon = $soCon;
    }

    abstract public function tinhTienLuong();
    abstract public function tinhTroCap();

    public function tinhTienThuong() {
        $namLamViec = date_diff(date_create($this->ngayVaoLam), date_create('now'))->y;
        return $namLamViec * 1000000;
    }
}

class NhanVienVanPhong extends NhanVien {
    private $soNgayVang;
    const DINH_MUC_VANG = 3;
    const DON_GIA_PHAT = 100000;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang) {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soNgayVang = $soNgayVang;
    }

    public function tinhTienPhat() {
        if ($this->soNgayVang > self::DINH_MUC_VANG) {
            return ($this->soNgayVang - self::DINH_MUC_VANG) * self::DON_GIA_PHAT;
        }
        return 0;
    }

    public function tinhTroCap() {
        $troCap = 200000 * $this->soCon;
        if ($this->gioiTinh === 'Nữ') {
            $troCap *= 1.5;
        }
        return $troCap;
    }

    public function tinhTienLuong() {
        return self::LUONG_CO_BAN * $this->heSoLuong;
    }
}

class NhanVienSanXuat extends NhanVien {
    private $soSanPham;
    const DINH_MUC_SAN_PHAM = 100;
    const DON_GIA_SAN_PHAM = 50000;

    public function __construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham) {
        parent::__construct($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon);
        $this->soSanPham = $soSanPham;
    }

    public function tinhTienThuong() {
        if ($this->soSanPham > self::DINH_MUC_SAN_PHAM) {
            return ($this->soSanPham - self::DINH_MUC_SAN_PHAM) * self::DON_GIA_SAN_PHAM * 0.03;
        }
        return 0;
    }

    public function tinhTroCap() {
        return $this->soCon * 120000;
    }

    public function tinhTienLuong() {
        return $this->soSanPham * self::DON_GIA_SAN_PHAM;
    }
}
// Xử lý form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['ho_ten'];
    $gioiTinh = $_POST['gioi_tinh'];
    $ngaySinh = $_POST['ngay_sinh'];
    $ngayVaoLam = $_POST['ngay_vao_lam'];
    $heSoLuong = floatval($_POST['he_so_luong']);
    $soCon = intval($_POST['so_con']);
    $loaiNhanVien = $_POST['loai_nhan_vien'];
    $soNgayVang = intval($_POST['so_ngay_vang']);
    $soSanPham = intval($_POST['so_san_pham']);

    if ($loaiNhanVien == 'Văn phòng') {
        $nhanVien = new NhanVienVanPhong($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soNgayVang);
    } else {
        $nhanVien = new NhanVienSanXuat($hoTen, $gioiTinh, $ngayVaoLam, $heSoLuong, $soCon, $soSanPham);
    }

    $tienLuong = $nhanVien->tinhTienLuong();
    $troCap = $nhanVien->tinhTroCap();
    $tienThuong = $nhanVien->tinhTienThuong();
    $tienPhat = ($nhanVien instanceof NhanVienVanPhong) ? $nhanVien->tinhTienPhat() : 0;
    $thucLinh = $tienLuong + $troCap + $tienThuong - $tienPhat;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f0f0f0; }
        .container { width: 600px; margin: 20px auto; background-color: #fff; border: 1px solid #ccc; padding: 10px; }
        h1 { text-align: center; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 5px; }
        input[type="text"], input[type="date"], input[type="number"] { width: 90%; }
        input[type="radio"] { margin-right: 5px; }
        .yellow-bg { background-color: #ffffc0; }
        .calc-row {background-color: #ffffc0;}
        .calc-row td { padding-top: 7px; }
        .full-width input { width: 100%; }
        .text-right { text-align: right; }
        button { display: block; margin: 10px auto; padding: 6px 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>QUẢN LÝ NHÂN VIÊN</h1>
        <form method="post">
            <table>
                <tr class="yellow-bg">
                    <td><label for="ho_ten">Họ và tên:</label></td>
                    <td><input type="text" id="ho_ten" name="ho_ten" value="<?php echo isset($hoTen) ? $hoTen : 'Nguyễn Thị Hoa Hồng'; ?>" required></td>
                    <td><label for="so_con">Số con:</label></td>
                    <td><input type="number" id="so_con" name="so_con" value="<?php echo isset($soCon) ? $soCon : '2'; ?>" required></td>
                </tr>
                <tr class="yellow-bg">
                    <td><label for="ngay_sinh">Ngày sinh:</label></td>
                    <td><input type="date" id="ngay_sinh" name="ngay_sinh" value="<?php echo isset($ngaySinh) ? $ngaySinh : '1987-03-12'; ?>" required></td>
                    <td><label for="ngay_vao_lam">Ngày vào làm:</label></td>
                    <td><input type="date" id="ngay_vao_lam" name="ngay_vao_lam" value="<?php echo isset($ngayVaoLam) ? $ngayVaoLam : '2012-10-20'; ?>" required></td>
                </tr>
                <tr class="yellow-bg">
                    <td><label>Giới tính:</label></td>
                    <td>
                        <input type="radio" id="nam" name="gioi_tinh" value="Nam" <?php echo (isset($gioiTinh) && $gioiTinh == 'Nam') ? 'checked' : ''; ?>>
                        <label for="nam">Nam</label>
                        <input type="radio" id="nu" name="gioi_tinh" value="Nữ" <?php echo (!isset($gioiTinh) || $gioiTinh == 'Nữ') ? 'checked' : ''; ?>>
                        <label for="nu">Nữ</label>
                    </td>
                    <td><label for="he_so_luong">Hệ số lương:</label></td>
                    <td><input type="number" id="he_so_luong" name="he_so_luong" value="<?php echo isset($heSoLuong) ? $heSoLuong : '2.0'; ?>" step="0.1" required></td>
                </tr>
                <tr class="yellow-bg">
                    <td><label>Loại nhân viên:</label></td>
                    <td colspan="3">
                        <input type="radio" id="van_phong" name="loai_nhan_vien" value="Văn phòng" <?php echo (!isset($loaiNhanVien) || $loaiNhanVien == 'Văn phòng') ? 'checked' : ''; ?>>
                        <label for="van_phong">Văn phòng</label>
                        <input type="radio" id="san_xuat" name="loai_nhan_vien" value="Sản xuất" <?php echo (isset($loaiNhanVien) && $loaiNhanVien == 'Sản xuất') ? 'checked' : ''; ?>>
                        <label for="san_xuat">Sản xuất</label>
                    </td>
                </tr>
                <tr class="yellow-bg">
                    <td><label for="so_ngay_vang">Số ngày vắng:</label></td>
                    <td><input type="number" id="so_ngay_vang" name="so_ngay_vang" value="<?php echo isset($soNgayVang) ? $soNgayVang : '3'; ?>"></td>
                    <td><label for="so_san_pham">Số sản phẩm:</label></td>
                    <td><input type="number" id="so_san_pham" name="so_san_pham" value="<?php echo isset($soSanPham) ? $soSanPham : ''; ?>"></td>
                </tr>
                <tr>
                    <td colspan="4"><button type="submit">Tính lương</button></td>
                </tr>
                <?php if (isset($tienLuong)): ?>
                <tr class="calc-row">
                    <td><label for="tien_luong">Tiền lương:</label></td>
                    <td><input type="text" id="tien_luong" name="tien_luong" value="<?php echo number_format($tienLuong, 0, ',', '.') . ' VNĐ'; ?>" readonly></td>
                    <td><label for="tro_cap">Trợ cấp:</label></td>
                    <td><input type="text" id="tro_cap" name="tro_cap" value="<?php echo number_format($troCap, 0, ',', '.') . ' VNĐ'; ?>" readonly></td>
                </tr>
                <tr class="calc-row">
                    <td><label for="tien_thuong">Tiền thưởng:</label></td>
                    <td><input type="text" id="tien_thuong" name="tien_thuong" value="<?php echo number_format($tienThuong, 0, ',', '.') . ' VNĐ'; ?>" readonly></td>
                    <td><label for="tien_phat">Tiền phạt:</label></td>
                    <td><input type="text" id="tien_phat" name="tien_phat" value="<?php echo number_format($tienPhat, 0, ',', '.') . ' VNĐ'; ?>" readonly></td>
                </tr>
                <tr class="calc-row">
                    <td><label for="thuc_linh">Thực lĩnh:</label></td>
                    <td rowspan="3" class="full-width" style="text-align: center;">
                        <input type="text" id="thuc_linh" name="thuc_linh" value="<?php echo number_format($thucLinh, 0, ',', '.') . ' VNĐ'; ?>" readonly class="text-right">
                    </td>
                </tr>
                <?php endif; ?>
            </table>
        </form>
    </div>
</body>
</html>