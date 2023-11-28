<?php

require_once('../../../config/database/functions/duracionCurso.php');

$id_duracion=$_GET['id_duracion'];

baja_duracionCurso($id_duracion);

header("location: formularioDuracionCurso.php");