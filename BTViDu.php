<style>
  table {
    float: left;
    width: 120px;
  }
</style>
<?php
//Gia tri n =3, lam bang cuu chuong 3
    // $n =3;
    // echo"Bang cuu chuong $n <br>";
    // echo"Bản đẹp pro max<br>";
    // for($i=1;$i<=10;$i++){

    // $nhan=$i*$n;
    // echo "$i * $n = $nhan<br>";
    // }

//Bai 1 n tu 1>100 xuat ra so chan
    // $n = rand(1,100);
    // echo "Gia tri n la $n.<br>";
    // echo "Cac so chan < $n la: ";
    // for($i=1;$i<=$n;$i++)
    //     if($i%2==0)  
    //         echo "$i  ";
// Bai 2 Gia tri n tu 1>10, lam bang cuu chuong 
for($i=1; $i<=10; $i++) {
    echo "<table style='border: 1px solid black; margin-bottom: 10px;padding: 2px'>";
    echo "<tr><th colspan='2'>Bảng cửu chương số $i</th></tr>";
    for($j=1; $j<=10; $j++) {
      $nhan = $i * $j;
      echo "<tr>";
      echo "<td>$i * $j = $nhan<br></td>";
      echo "</tr>";
    }
    echo "</table>";
  }
/*Bai 3 cho 1>n(n<=10000)
Ktra n phai ngto?
Tinh tong cac so le có 2 chu so va nho hon n
cho bit n co bao nhiu chu so*/
    // define('N', 10000);
    // $n = rand(1, N);
    // // Kiểm tra n có phải là số nguyên tố
    // function Ngto($n) {
    //     if ($n < 2) return false;
    //     for ($i = 2; $i <= sqrt($n); $i++) {
    //         if ($n % $i == 0)
    //         return false;
    //     }

    //     return true;
    // }
    // if (Ngto($n)) {
    //     echo "$n là số nguyên tố.<br>";
    // } else {
    //     echo "$n không phải là số nguyên tố.<br>";
    // }
    // // Tính tổng các số lẻ có 2 chữ số và nhỏ hơn n
    // $sum = 0;
    // for ($i = 11; $i < 99; $i += 2) {
    // $sum += $i;
    // }
    // echo "Tổng số lẻ có 2 chữ số và nhỏ hơn $n là: $sum.<br>";

    // // Đếm số chữ số của n
    // $demso =strlen((string)$n);
    // echo "$n có $demso chữ số.";
?>