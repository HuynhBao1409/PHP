    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

    <html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>tinh dien tich va chu vi tam giac</title>
        <style type="text/css">
            body {  
                background-color: #d24dff;
            }
            table{
                background: #ffd94d;
                border: 0 solid yellow;
            }
            thead{
                background: #fff14d;    
            }
            td {
                color: blue;
            }
            h3{
                font-family: verdana;

                text-align: center;
                /* text-anchor: middle; */
                color: #ff8100;

                font-size: medium;
            }
        </style>
    </head>

    <body>
    <?php 

    if(isset($_POST['canhA']))  

        $canhA=trim($_POST['canhA']); 
    else $canhA="";
    if(isset($_POST['canhB'])) 
        $canhB=trim($_POST['canhB']); 
    else $canhB="";
    if(isset($_POST['canhC'])) 
        $canhC=trim($_POST['canhC']); 
    else $canhC="";
    if(isset($_POST['tinh']))
            if (is_numeric($canhA) && is_numeric($canhB) && is_numeric($canhC)) {
                $chuvi = $canhA + $canhB + $canhC;
                $p = $chuvi / 2;
                $dientich = sqrt($p * ($p - $canhA) * ($p - $canhB) * ($p - $canhC ));
                $chuvi = number_format($chuvi, 2);
                $dientich = number_format($dientich, 2);
            }
            else {
                echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
                    $chuvi="";
                    $dientich="";
                }
    else{
        $dientich="";
        $chuvi="";
    }
    ?>
    <form alig  n='center' action="dientich_tg.php" method="post">
    <table>
        <thead>
            <th colspan="2" align="center"><h3>DIỆN TÍCH HÌNH TAM GIÁC</h3></th>

        </thead>
        <tr><td>Chiều dài cạnh a:</td>

        <td><input type="text" name="canhA" value="<?php  echo $canhA;?> "/></td>

        </tr>
        <tr><td>Chiều dài cạnh b:</td>

        <td><input type="text" name="canhB" value="<?php  echo $canhB;?> "/></td>

        </tr>
        <tr><td>Chiều dài cạnh c:</td>

        <td><input type="text" name="canhC" value="<?php  echo $canhC;?> "/></td>

        </tr>
        <tr><td>Diện tích:</td>
        <td><input type="text" name="dientich" disabled="disabled" value="<?php  echo $dientich;?> "/></td>

        </tr>
        <tr><td>Chu vi:</td>
        <td><input type="text" name="chuvi" disabled="disabled" value="<?php  echo $chuvi;?> "/></td>

        </tr>
        <tr>

        <td colspan="2" align='center'><input type="submit" value="Tính" name="tinh" /></td>
        </tr>
    </table>
    </form>
    </body>
    </html>