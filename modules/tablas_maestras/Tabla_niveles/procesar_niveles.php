<?php
require_once('../../../config/database/functions/niveles.php');

$valor= $_POST['nuevo_nivel'];

if(!empty(trim($valor))){
    alta_niveles($valor);
    header("location: formulario_niveles.php");
}else{
    header("location: formulario_niveles.php");
}