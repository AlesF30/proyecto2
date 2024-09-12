<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\perfil.php');

$id_perfil = $_POST['id_perfil'];
$descripcion = $_POST['descripcion'];

modificar_perfil($id_perfil, $descripcion);

header('location:listado_perfil.php');
?>
