<?php
require_once('../../../config/database/functions/tipo_sexo.php');

$valor= $_POST['nuevo_sexo'];

if(!empty(trim($valor))){
    alta_tipo_sexo($valor);
    header("location: formulario_tipo_sexo.php");
}else{
    header("location: formulario_tipo_sexo.php");
}