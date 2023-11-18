<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


include(ROOT_PATH . 'config/database/functions/contratos.php');


$cursos_fecha_inicio= $_POST['cursos_fecha_inicio'];
$cursos_fecha_fin= $_POST['cursos_fecha_fin'];
$cursos_nombre= $_POST['cursos_nombre'];
$cursos_estado= $_POST['cursos_estado'];
$cursos_precio= $_POST['cursos_precio'];
$id_niveles= $_POST['niveles'];
$id_modalidad= $_POST['modalidad'];
$id_periodos= $_POST['periodos'];
$duracion= $_POST['duracion'];
$id_categoria= $_POST['categoria_eventos'];
$id_clientes= $_POST['clientes'];
$evento_estado=$_POST['evento_estado'];


alta_cursos($id_niveles, $id_modalidad, $id_periodos, $cursos_fecha_inicio, $cursos_fecha_fin, $cursos_nombre, $cursos_estado, $cursos_precio, $duracion);

alta_eventos($id_tipo, $id_categoria, $evento_estado);


header('location:../contratos/listadoContrato.php');



?>