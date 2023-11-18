<?php

require_once('../../../config/database/functions/niveles.php');

$id_niveles=$_GET['id_niveles'];

baja_niveles($id_niveles);

header("location: formulario_niveles.php");