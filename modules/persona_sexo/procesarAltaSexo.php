<?php


require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


$idTipoSexo = $_POST['selectTipoSexo'];
$valor = $_POST['selectTipoSexo'];
$id_persona = $_POST['id_persona'];
$modulo = $_POST['modulo'];


crear_nuevo_sexo($id_persona, $idTipoSexo, $valor) ;

header("location: altaSexo.php?id_persona=$id_persona&modulo=$modulo");



?>