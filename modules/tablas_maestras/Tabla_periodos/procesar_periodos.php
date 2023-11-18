<?php
require_once('../../../config/database/functions/periodos.php');

$valor= $_POST['nuevo_periodo'];

if(!empty(trim($valor))){
    alta_periodos($valor);
    header("location: formulario_periodos.php");
}else{
    header("location: formulario_periodos.php");
}