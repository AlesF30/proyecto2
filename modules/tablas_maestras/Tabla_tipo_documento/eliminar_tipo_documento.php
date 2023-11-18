<?php

require_once('../../../config\database\functions\tipo_documento.php');

$id_tipo_documento=$_GET['id_tipo_documento'];

baja_tipo_documento($id_tipo_documento);

header("location: formulario_tipo_documento.php");