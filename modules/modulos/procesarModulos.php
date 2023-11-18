<?php
require_once('../../config\database\functions\modulos.php');

$modulos= $_POST['nuevo_modulo'];

if(!empty(trim($modulos))){
    alta_modulos($modulos);
    header("location: listado_modulos.php");
}else{
    header("location: listado_modulos.php");
}