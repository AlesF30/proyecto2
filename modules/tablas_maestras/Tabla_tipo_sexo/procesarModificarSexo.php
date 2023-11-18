<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\tipo_sexo.php');


$id_tipo_sexo= $_POST['id_tipo_sexo'];
$descripcion= $_POST['descripcion'];

modificar_tipoSexo($id_tipo_sexo, $descripcion);

header('location:../Tabla_tipo_sexo/formulario_tipo_sexo.php');


?>