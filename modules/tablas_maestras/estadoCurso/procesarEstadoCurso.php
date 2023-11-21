<?php
require_once('../../../config/database/functions/estadoCurso.php');

$valor= $_POST['nuevo_curso_estado'];

if(!empty(trim($valor))){
    alta_estadoCurso($valor);
    header("location: formularioEstadoCurso.php");
}else{
    header("location: formularioEstadoCurso.php");
}