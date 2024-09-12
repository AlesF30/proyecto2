<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH . 'config/database/functions/usuarios.php');

$id_usuario = $_POST['id_usuario'];
$id_perfil = $_POST['perfil'];
$usuario = $_POST['usuario'];

modificar_usuario($id_usuario, $id_perfil, $usuario);

header('location: listadoUsuario.php');

?>
