<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\personas.php');


$id_persona=$_POST['id_persona'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$FechaNac=$_POST['FechaNac'];
$profesionales_descripcion=$_POST['profesionales_descripcion'];

modificar_profesionales($id_persona, $nombre, $apellido, $FechaNac, $profesionales_descripcion);

header('location:listadoProfesionales.php');



?>