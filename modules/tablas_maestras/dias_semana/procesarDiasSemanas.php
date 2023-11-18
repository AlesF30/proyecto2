<?php
require_once('../../../config/database/functions/dias_semana.php');

$valor= $_POST['nuevo_diaSemana'];

if(!empty(trim($valor))){
    alta_diasSemana($valor);
    header("location: formularioDiasSemanas.php");
}else{
    header("location: formularioDiasSemanas.php");
}