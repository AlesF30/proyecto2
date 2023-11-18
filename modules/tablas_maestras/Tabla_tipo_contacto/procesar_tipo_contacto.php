<?php

require_once('../../../config/database/functions/tipo_contacto.php');

$valor= $_POST['nuevo_contacto'];

if(!empty(trim($valor))){
    alta_tipo_contacto($valor);
    header("location: formulario_tipo_contacto.php");
}else{
    header("location: formulario_tipo_contacto.php");
}