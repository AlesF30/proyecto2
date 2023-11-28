<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\cursos.php');


$id_cursos=$_POST['id_cursos'];
$cursos_fecha_inicio= $_POST['cursos_fecha_inicio'];
$cursos_fecha_fin= $_POST['cursos_fecha_fin'];
$cursos_nombre= $_POST['cursos_nombre'];
$cursos_precio= $_POST['cursos_precio'];

$estado_curso= $_POST['estado_curso'];

$id_niveles= $_POST['niveles'];
$id_modalidad= $_POST['modalidad'];
$id_periodos= $_POST['periodos'];

$idDuracion= $_POST['duracion'];
$valor= $_POST['valor'];



modificar_cursos($id_cursos, $id_niveles, $id_modalidad, $id_periodos, $estado_curso, $cursos_fecha_inicio, $cursos_fecha_fin, $cursos_nombre, $cursos_precio);

header('location:listadoCursos.php');



?>