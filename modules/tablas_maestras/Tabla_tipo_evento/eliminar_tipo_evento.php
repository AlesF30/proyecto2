<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once('../../../config/database/functions/tipo_evento.php');

$id_tipo_evento=$_GET['id_tipo'];

baja_tipo_evento($id_tipo_evento);

header("location: formulario_tipo_evento.php");