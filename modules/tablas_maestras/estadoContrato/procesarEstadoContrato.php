<?php
require_once('../../../config/database/functions/estadoContrato.php');

$valor= $_POST['nuevo_contrato_estado'];

if(!empty(trim($valor))){
    alta_estadoContrato($valor);
    header("location: formularioEstadoContrato.php");
}else{
    header("location: formularioEstadoContrato.php");
}