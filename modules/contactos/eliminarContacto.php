<?php


require_once ('../../config/database/connect.php');
include ('../../config/database/functions/personas.php');

$id_persona_contacto = $_GET['id_persona_contacto'];
$id_persona = $_GET['id_persona'];
$modulo = $_GET['modulo'];


global $connect;

$sql = "DELETE FROM persona_contacto WHERE id_persona_contacto=$id_persona_contacto";
$connect->query($sql);

header("location: altaContactos.php?id_persona=$id_persona&modulo=$modulo");


?>