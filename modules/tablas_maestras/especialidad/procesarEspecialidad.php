<?php
require_once('../../../config/database/functions/especialidad.php');

$especialidad_descripcion= $_POST['nueva_especialidad'];

if(!empty(trim($especialidad_descripcion))){
    alta_especialidad($especialidad_descripcion);
    header("location: formularioEspecialidad.php");
}else{
    header("location: formularioEspecialidad.php");
}