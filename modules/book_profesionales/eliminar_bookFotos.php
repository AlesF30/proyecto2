<?php


require_once ('../../config/database/connect.php');
include ('../../config/database/functions/book_profesionales.php');


$id_book_profesionales = $_GET['id_book_profesionales'];
$id_profesionales = $_GET['id_profesionales'];
$modulo = $_GET['modulo'];


global $connect;

$sql = "DELETE FROM book_profesionales WHERE id_book_profesionales=$id_book_profesionales";
$connect->query($sql);

header("location: ..\profesionales\opcionesProfesionales.php?id_profesionales=$id_profesionales&modulo=$modulo");


?>