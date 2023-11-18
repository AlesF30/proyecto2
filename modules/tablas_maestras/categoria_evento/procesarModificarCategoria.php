<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\categoria_evento.php');


$id_categoria=$_POST['id_categoria'];
$categoria_descripcion=$_POST['categoria_descripcion'];
$precio=$_POST['precio'];


modificar_categoria_eventos($id_categoria, $categoria_descripcion, $precio);


header("location: ../categoria_evento/formulario_categoriaEvento.php");

?>