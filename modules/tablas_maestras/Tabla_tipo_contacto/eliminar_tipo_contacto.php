<?php

require_once('../../../config/database/functions/tipo_contacto.php');

$id_tipo_contacto=$_GET['id_tipo_contacto'];

baja_tipo_contacto($id_tipo_contacto);

header("location: formulario_tipo_contacto.php");