<?php
require_once('../../../config/database/functions/pais.php');

$valor= $_POST['nuevo_pais'];

if(!empty(trim($valor))){
    alta_pais($valor);
    header("location: formulario_pais.php");
}else{
    header("location: formulario_pais.php");
}