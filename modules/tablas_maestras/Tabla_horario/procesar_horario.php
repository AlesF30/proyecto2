<?php
require_once('../../../config/database/functions/horario.php');

$valor= $_POST['nuevo_horario'];

if(!empty(trim($valor))){
    alta_horarios($valor);
    header("location: formulario_horario.php");
}else{
    header("location: formulario_horario.php");
}