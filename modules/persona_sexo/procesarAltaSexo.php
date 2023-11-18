<?php


require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


$idTipoSexo = $_POST['selectTipoSexo'];
$valor = $_POST['valor'];
$id_persona = $_POST['id_persona'];
$modulo = $_POST['modulo'];


crear_nuevo_sexo($idTipoSexo, $valor, $id_persona);

header("location: altaSexo.php?id_persona=$id_persona&modulo=$modulo");



?>