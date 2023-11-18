<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH . 'config/database/functions/usuarios.php');

$id_persona= $_POST['persona'];
$id_perfil= $_POST['perfil'];
$usuario=$_POST['usuario'];
$password=$_POST['password'];



registrarUsuario($id_persona, $id_perfil, $usuario, $password);


header('location:../usuarios/listadoUsuario.php');



?>