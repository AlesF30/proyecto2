<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\personas.php');

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$FechaNac=$_POST['FechaNac'];
$documento=$_POST['documento'];
$tipodoc=$_POST['tipodoc'];
$profesionales_descripcion=$_POST['profesionales_descripcion'];


$id_persona = crear_persona($nombre, $apellido, $FechaNac);

alta_documento($tipodoc, $documento, $id_persona);

$id_profesionales= crear_profesionales($id_persona, $id_contrato, $profesionales_descripcion);

header('location:..\usuarios\formularioProfesionales_usuario.php?id_persona='.$id_persona);


?>