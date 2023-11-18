<?php

require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


$idCaracteristica = $_POST['caracteristica'];
$valor = $_POST['valor'];
$id_persona = $_POST['id_persona'];
$modulo = $_POST['modulo'];


crear_nuevo_fisico($id_persona, $idCarcateristica, $valor);

header("location: altaPersonaFisico.php?id_persona=$id_persona&modulo=$modulo");



?>