<?php
require_once('../../../config\database\functions\duracionCurso.php');

$descripcionDuracion= $_POST['nueva_duracionCurso'];

if(!empty(trim($descripcionDuracion))){
    alta_duracionCurso($descripcionDuracion);
    header("location: formularioDuracionCurso.php");
}else{
    header("location: formularioDuracionCurso.php");
}