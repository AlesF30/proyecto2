<?php


require_once ('../../config/database/connect.php');
// require_once ('../../config/path.php');
include ('../../config/database/functions/personas.php');

$id_persona_sexo = $_GET['id_persona_sexo'];
$id_persona = $_GET['id_persona'];
$modulo = $_GET['modulo'];


global $connect;

$sql = "DELETE FROM persona_sexo WHERE id_persona_sexo=$id_persona_sexo";
$connect->query($sql);

header("location: altaSexo.php?id_persona=$id_persona&modulo=$modulo");


?>