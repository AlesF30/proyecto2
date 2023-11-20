<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');

include(ROOT_PATH . 'config/database/functions/evento.php');

$id_eventos=$_POST['id_eventos'];
$id_tipo= $_POST['tipo_evento'];
$id_categoria= $_POST['categoria_eventos'];
$idEvento_estado=$_POST['evento_estado'];

alta_eventos($idEvento_estado, $id_tipo, $id_categoria);

header("location: formularioEventos.php");




?>