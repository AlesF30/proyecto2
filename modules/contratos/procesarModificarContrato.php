<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
include(ROOT_PATH.'config\database\functions\contratos.php');


$id_contrato=$_POST['id_contrato'];
$contrato_estado=$_POST['contrato_estado'];

modificar_contrato($id_contrato, $contrato_estado);

header('location:listadoContrato.php');



?>