<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


include(ROOT_PATH . 'config/database/functions/contratos.php');


$contrato_fecha_alta= $_POST['contrato_fecha_alta'];
$contrato_dias= $_POST['contratos_dias'];
$contrato_precio= $_POST['contrato_precio'];
$contrato_estado= $_POST['contrato_estado'];
$id_eventos= $_POST['eventos'];

$id_tipo= $_POST['tipo_evento'];
$id_categoria= $_POST['categoria_eventos'];
$id_clientes= $_POST['clientes'];
$evento_estado=$_POST['evento_estado'];



alta_contratos($id_clientes, $id_eventos, $contrato_fecha_alta, $contrato_dias, $contrato_precio, $contrato_estado);
alta_eventos($id_tipo, $id_categoria, $evento_estado);


header('location:../contratos/listadoContrato.php');



?>