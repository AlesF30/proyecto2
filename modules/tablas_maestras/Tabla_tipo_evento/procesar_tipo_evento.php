<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once('../../../config/database/functions/tipo_evento.php');

$valor= $_POST['nuevo_tipo_evento'];

if(!empty(trim($valor))){
    alta_tipo_evento($valor);
    header("location: formulario_tipo_evento.php");
}else{
    header("location: formulario_tipo_evento.php");
}