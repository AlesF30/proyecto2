<?php

require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/sponsor.php');


$idEvento = $_POST['id_eventos'];
$id_sponsor = $_POST['id_sponsor'];
$id_persona = $_POST['selectTipoSexo'];
$modulo = $_POST['modulo'];


crear_nuevo_sexo($idTipoSexo, $valor, $id_persona);

header("location: altaSexo.php?id_persona=$id_persona&modulo=$modulo");



?>