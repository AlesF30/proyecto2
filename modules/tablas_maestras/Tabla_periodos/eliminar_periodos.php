<?php

require_once('../../../config/database/functions/periodos.php');

$id_periodos=$_GET['id_periodos'];

baja_periodos($id_periodos);

header("location: formulario_periodos.php");