<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH . 'config/database/functions/usuarios.php');

$id_persona= $_POST['id_persona'];
$id_perfil= $_POST['perfil'];
$usuario=$_POST['usuario'];
$password=$_POST['contrasena'];



registrarUsuario($id_persona, $id_perfil, $usuario, $password);


header('location:../docentes/listadoDocente.php');



?>