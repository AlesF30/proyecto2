<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\persona_fisico.php');
include(ROOT_PATH . 'config/database/functions/personas.php');


$id_persona_fisico= $_POST['id_persona_fisico'];
$id_persona = $_POST['id_persona'];
$valor=$_POST['valor'];
$modulo = $_POST['modulo'];

modificar_personaFisico($id_persona_fisico, $valor);

header("location: ../personaFisico/altaPersonaFisico.php");

?>