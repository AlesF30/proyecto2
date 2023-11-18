<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once('../../../config/database/functions/categoria_evento.php');

$id_categoria=$_GET['$id_categoria'];

baja_categoria_eventos($id_categoria);

header("location: formulario_categoriaEvento.php");