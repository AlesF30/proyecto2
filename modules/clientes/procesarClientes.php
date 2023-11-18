<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\personas.php');

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$FechaNac=$_POST['FechaNac'];
$documento=$_POST['documento'];
$tipodoc=$_POST['tipodoc'];
$nombre_empresa=$_POST['nombre_empresa'];


$id_persona = crear_persona($nombre, $apellido, $FechaNac);

alta_documento($tipodoc, $documento, $id_persona);

$id_clientes= crear_clientes($id_persona, $nombre_empresa);

header('location:..\usuarios\formularioCliente_usuario.php?id_persona='.$id_persona);


?>