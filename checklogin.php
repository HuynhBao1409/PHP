<?php
$username=$_POST['user'];
$password=$_POST['pass'];
if($username== "admin" && $password=="12345"){
    echo "<font color=black> <b> Welcome to, <b>" .$username. "<font>";

}
else{
    echo "<font color=red> Username hoac password khong chinh xac,
    Vui long thu lai<font>";
}
?>