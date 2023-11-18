<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\evento.php');


$id_eventos=$_POST['id_eventos'];
$idEvento_estado=$_POST['evento_estado'];


modificar_eventos($id_eventos, $idEvento_estado);

header('location:formularioEventos.php');



?>