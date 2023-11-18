<?php
require_once('../../../config/database/functions/duracion_dias.php');

$valor= $_POST['nueva_duracionDias'];

if(!empty(trim($valor))){
    alta_duracionDias($valor);
    header("location: formularioDuracionDias.php");
}else{
    header("location: formularioDuracionDias.php");
}