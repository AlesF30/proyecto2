<?php

require_once('../../../config\database\functions\tipo_documento.php');

$valor= $_POST['nuevo_documento'];

if(!empty(trim($valor))){
    alta_tipo_documento($valor);
    header("location: formulario_tipo_documento.php");
}else{
    header("location: formulario_tipo_documento.php");
}