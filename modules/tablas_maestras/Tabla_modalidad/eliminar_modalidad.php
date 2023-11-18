<?php

require_once('../../../config/database/functions/modalidades.php');

$id_modalidad=$_GET['id_modalidad'];

baja_modalidad($id_modalidad);

header("location: formulario_modalidad.php");