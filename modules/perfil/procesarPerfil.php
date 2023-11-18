<?php
require_once('../../config\database\functions\perfil.php');

$perfil= $_POST['nuevo_perfil'];

if(!empty(trim($perfil))){
    alta_perfil($perfil);
    header("location: listado_perfil.php");
}else{
    header("location: listado_perfil.php");
}