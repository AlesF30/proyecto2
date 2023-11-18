<?php


require_once ('../../config/database/connect.php');
include ('../../config/database/functions/personas.php');


$id_persona_documento = $_GET['id_persona_documento'];
$id_persona = $_GET['id_persona'];
$modulo = $_GET['modulo'];


global $connect;

$sql = "DELETE FROM persona_documento WHERE id_persona_documento=$id_persona_documento";
$connect->query($sql);

header("location: altaDocumentos.php?id_persona=$id_persona&modulo=$modulo");


?>