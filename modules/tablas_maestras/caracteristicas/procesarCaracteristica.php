<?php
require_once('../../../config/database/functions/caracteristica.php');

$valor= $_POST['nueva_caracteristica'];

if(!empty(trim($valor))){
    alta_caracteristica($valor);
    header("location: formularioCaracteristica.php");
}else{
    header("location: formularioCaracteristica.php");
}