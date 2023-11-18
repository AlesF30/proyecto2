<?php


require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


$idTipoContacto = $_POST['selectTipoContactos'];
$valor = $_POST['valor'];
$id_persona = $_POST['id_persona'];
$modulo = $_POST['modulo'];


crear_nuevo_contacto($idTipoContacto, $valor, $id_persona);

header("location: altaContactos.php?id_persona=$id_persona&modulo=$modulo");



?>