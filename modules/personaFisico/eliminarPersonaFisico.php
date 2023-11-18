<?php


require_once ('../../config/database/connect.php');
include ('../../config/database/functions/personas.php');

$id_persona_fisico = $_GET['id_persona_fisico'];
$id_persona = $_GET['id_persona'];
$modulo = $_GET['modulo'];


global $connect;

$sql = "DELETE FROM persona_fisico WHERE id_persona_fisico=$id_persona_fisico";
$connect->query($sql);

header("location: altaPersonaFisico.php?id_persona=$id_persona&modulo=$modulo");


?>