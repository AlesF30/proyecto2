<?php
$host='localhost';
$user='root';
$pass='';
$db='sistbook';

$connect = new mysqli($host, $user ,$pass,$db);
if ($connect->connect_error){
    die("Problemas con la conexi�n a la base de datos");
}


?>