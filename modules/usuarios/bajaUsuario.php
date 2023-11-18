<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\usuarios.php');

$id_usuario = $_GET['id_usuario'];


baja_usuario($id_usuario);

header('location:listadoUsuario.php');

?>
