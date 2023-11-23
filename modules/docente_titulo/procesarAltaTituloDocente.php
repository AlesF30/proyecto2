<?php


require_once('../../config/path.php');
include(ROOT_PATH . 'config/database/functions/personas.php');

$id_docentes = $_POST ['id_docentes']
$id_profesion = $_POST['id_profesion'];
$valor = $_POST['profesion'];
$fechaTitulo = $_POST['fecha_titulo'];
$modulo = $_POST['modulo'];


crear_nuevo_tituloDocente($id_docentes, $id_profesion, $fechaTitulo);

alta_profesion($valor);

header("location: altaTituloDocente.php?id_docentes=$id_docentes&modulo=$modulo");



?>