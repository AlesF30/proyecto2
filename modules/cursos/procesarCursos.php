<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


include(ROOT_PATH . 'config/database/functions/cursos.php');


$cursos_fecha_inicio= $_POST['cursos_fecha_inicio'];
$cursos_fecha_fin= $_POST['cursos_fecha_fin'];
$cursos_nombre= $_POST['cursos_nombre'];
$cursos_precio= $_POST['cursos_precio'];

$estado_curso= $_POST['estado_curso'];

$id_niveles= $_POST['niveles'];
$id_modalidad= $_POST['modalidad'];
$id_periodos= $_POST['periodos'];
$duracion= $_POST['duracion'];


alta_cursos($id_niveles, $id_modalidad, $id_periodos, $estado_curso, $cursos_fecha_inicio, $cursos_fecha_fin, $cursos_nombre, $cursos_precio);

altaCurso_duracion($id_curso, $duracion, $valor);


header('location:../cursos/listadoCursos.php');



?>