<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\modulos.php');

$id_modulos = $_GET['id_modulos'];


baja_modulos($id_modulos);

header('location:listado_modulos.php');

?>
