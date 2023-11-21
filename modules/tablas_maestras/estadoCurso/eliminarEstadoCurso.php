<?php

require_once('../../../config/database/functions/estadoCurso.php');

$id_estado_curso=$_GET['id_estado_curso'];

baja_estadoCurso($id_estado_curso);

header("location: formularioEstadoCurso.php");