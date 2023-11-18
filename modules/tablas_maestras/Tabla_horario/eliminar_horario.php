<?php

require_once('../../../config/database/functions/horarios.php');

$id_horarios=$_GET['id_horarios'];

baja_horarios($id_horarios);

header("location: formulario_horarios.php");