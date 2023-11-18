<?php

require_once('../../../config/database/functions/tipo_sexo.php');

$id_tipo_sexo=$_GET['id_tipo_sexo'];

baja_tipo_sexo($id_tipo_sexo);

header("location: formulario_tipo_sexo.php");