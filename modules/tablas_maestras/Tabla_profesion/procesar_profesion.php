<?php
require_once('../../../config/database/functions/profesion.php');

$valor= $_POST['nueva_profesion'];

if(!empty(trim($valor))){
    alta_profesion($valor);
    header("location: formulario_profesion.php");
}else{
    header("location: formulario_profesion.php");
}