<?php

require_once('../../../config/database/functions/duracion_dias.php');

$id_duracion_dias=$_GET['id_duracion_dias'];

baja_diasSemana($id_dias);

header("location: formularioDiasSemanas.php");