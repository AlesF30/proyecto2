<?php


require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


$idTipoDocumento = $_POST['selectTipoDocumento'];
$valor = $_POST['valor'];
$id_persona = $_POST['id_persona'];
$modulo = $_POST['modulo'];


alta_documento($idTipoDocumento, $valor, $id_persona);

header("location: altaDocumentos.php?id_persona=$id_persona&modulo=$modulo");



?>