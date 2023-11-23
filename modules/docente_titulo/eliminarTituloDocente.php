<?php


require_once ('../../config/database/connect.php');
// require_once ('../../config/path.php');
include ('../../config/database/functions/personas.php');

$id_titulo_docente = $_GET['id_titulo_docente'];
$id_docentes = $_GET['id_docentes'];
$modulo = $_GET['modulo'];


global $connect;

$sql = "DELETE FROM titulo_docente WHERE id_titulo_docente=$id_titulo_docente";
$connect->query($sql);

header("location: altaTituloDocente.php?id_docentes=$id_docentes&modulo=$modulo");


?>