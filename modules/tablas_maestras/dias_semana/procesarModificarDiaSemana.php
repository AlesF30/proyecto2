<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\dias_semana.php');


$id_dias=$_POST['id_dias'];
$descripcion=$_POST['descripcion'];


modificar_diasSemana($id_dias, $descripcion);


header("location: ../dias_semana/formularioDiasSemanas.php");

?>