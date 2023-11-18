<?php

require_once('../../../config/database/functions/dias_semana.php');

$id_dias=$_GET['id_dias'];

baja($id_duracion_dias);

header("location: formularioDuracionDias.php");