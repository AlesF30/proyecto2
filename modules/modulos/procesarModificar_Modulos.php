<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\modulos.php');


$id_modulos= $_POST['id_modulos'];
$descripcion=$_POST['descripcion'];

modificar_modulos($id_modulos, $descripcion);

header('location:listado_modulos.php');


?>