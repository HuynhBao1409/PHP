<?php
$n = rand(-50, 50);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 4</title>
    <style>
        table {
            
            border-collapse: collapse;
            margin: 5px ;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: grey;
            color: white;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th colspan="2"><h3>Giá trị ngẫu nhiên n: <?php echo $n; ?></h3></th>
    </tr>
    <tr>
        <td colspan="2">
            <?php
            if ($n > 0) {
                echo "$n là số dương.";
            } elseif ($n < 0) {
                $n = -$n;
                echo "Đối số: $n";
            } else {
                echo "n là 0.";
            }
            ?>
        </td>
    </tr>
    <tr>
        <th>Phần tử</th>
        <th>Giá trị</th>
    </tr>
    <?php
    $a = array();
    for ($i = 0; $i < $n; $i++) {
        $a[$i] = rand(-100, 100);
        echo "<tr><th>$i</th><td>" . $a[$i] . "</td></tr>";
    }

    $tong = 0;
    for ($i = 0; $i < count($a); $i++) {
        if ($a[$i] % 2 != 0) {
            $tong += $a[$i];
        }
    }
    ?>

    <tr>
        <th colspan="2">
        <p style="text-align:center;">
            Tổng các phần tử lẻ trong mảng là: <strong><?php echo $tong; ?></strong>
        </p>
        </th>
    </tr>
</table>

</body>
</html>