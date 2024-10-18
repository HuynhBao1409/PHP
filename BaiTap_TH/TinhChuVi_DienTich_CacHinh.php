<?php 
abstract class Hinh {
    protected $ten, $dodai;

    public function setTen($ten) {
        $this->ten = $ten;
    }

    public function getTen() {
        return $this->ten;
    }

    public function setDodai($doDai) {
        $this->dodai = $doDai;
    }

    public function getDodai() {
        return $this->dodai;
    }

    abstract public function tinh_CV();
    abstract public function tinh_DT();
}

class HinhTron extends Hinh {
    const PI = 3.14;

    function tinh_CV() {
        return $this->dodai * 2 * self::PI;
    }

    function tinh_DT() {
        return pow($this->dodai, 2) * self::PI;
    }
}

class HinhVuong extends Hinh {
    public function tinh_CV() {
        return $this->dodai * 4;
    }

    public function tinh_DT() {
        return pow($this->dodai, 2);
    }
}

class HinhTamGiacDeu extends Hinh {
    public function tinh_CV() {
        return $this->dodai * 3;
    }

    public function tinh_DT() {
        return (sqrt(3) / 4) * pow($this->dodai, 2);
    }
}

class HinhChuNhat extends Hinh {
    protected $chieuRong;

    public function setChieuRong($chieuRong) {
        $this->chieuRong = $chieuRong;
    }

    public function tinh_CV() {
        return 2 * ($this->dodai + $this->chieuRong);
    }

    public function tinh_DT() {
        return $this->dodai * $this->chieuRong;
    }
}

$str = NULL;

if(isset($_POST['tinh'])) {
    if(isset($_POST['hinh'])) {
        switch($_POST['hinh']) {
            case "hv":
                $hinh = new HinhVuong();
                break;
            case "ht":
                $hinh = new HinhTron();
                break;
            case "tgd":
                $hinh = new HinhTamGiacDeu();
                break;
            case "hcn":
                $hinh = new HinhChuNhat();
                $hinh->setChieuRong($_POST['chieuRong']);
                break;
        }

        $hinh->setTen($_POST['ten']);
        $hinh->setDodai($_POST['dodai']);

        $str = "Diện tích của " . $hinh->getTen() . " là: " . $hinh->tinh_DT() . "\n" .
               "Chu vi của " . $hinh->getTen() . " là: " . $hinh->tinh_CV();
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tính chu vi và diện tích</title>
    <style>
        fieldset {
            background-color: #eeeeee;
        }
        legend {
            background-color: black;
            color: yellow;
            padding: 5px 10px;
        }
        input {
            margin: 5px;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <fieldset>
            <legend>Tính chu vi và diện tích các hình đơn giản</legend>
            <table border='0'>
                <tr>
                    <td>Chọn hình</td>
                    <td>
                        <input type="radio" name="hinh" value="hv" <?php if(isset($_POST['hinh']) && $_POST['hinh'] == "hv") echo 'checked'?>/>Hình vuông
                        <input type="radio" name="hinh" value="ht" <?php if(isset($_POST['hinh']) && $_POST['hinh'] == "ht") echo 'checked'?>/>Hình tròn
                        <input type="radio" name="hinh" value="tgd" <?php if(isset($_POST['hinh']) && $_POST['hinh'] == "tgd") echo 'checked'?>/>Hình tam giác đều
                        <input type="radio" name="hinh" value="hcn" <?php if(isset($_POST['hinh']) && $_POST['hinh'] == "hcn") echo 'checked'?>/>Hình chữ nhật
                    </td>
                </tr>
                <tr>
                    <td>Nhập tên:</td>
                    <td><input type="text" name="ten" value="<?php if(isset($_POST['ten'])) echo $_POST['ten'];?>"/></td>
                </tr>
                <tr>
                    <td>Nhập độ dài:</td>
                    <td><input type="text" name="dodai" value="<?php if(isset($_POST['dodai'])) echo $_POST['dodai'];?>"/></td>
                </tr>
                <tr id="chieuRongRow" style="display: none;">
                    <td>Nhập chiều rộng:</td>
                    <td><input type="text" name="chieuRong" value="<?php if(isset($_POST['chieuRong'])) echo $_POST['chieuRong'];?>"/></td>
                </tr>
                <tr>
                    <td>Kết quả:</td>
                    <td><textarea name="ketqua" cols="70" rows="4" disabled="disabled"><?php echo $str;?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="tinh" value="Tính"/></td>
                </tr>
            </table>
        </fieldset>
    </form>

    <script>
        document.querySelectorAll('input[name="hinh"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('chieuRongRow').style.display = this.value === 'hcn' ? 'table-row' : 'none';
            });
        });
    </script>
</body>
</html>