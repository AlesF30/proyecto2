<?php

require_once('../../../config/database/functions/especialidad.php');

$id_especialidad=$_GET['id_especialidad'];

baja_especialidad($id_especialidad);

header("location: formularioEspecialidad.php");