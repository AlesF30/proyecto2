<?php
require_once('../../../config/database/functions/grupo.php');

$valor= $_POST['nuevo_grupo'];

if(!empty(trim($valor))){
    alta_grupo($valor);
    header("location: formularioGrupo.php");
}else{
    header("location: formularioGrupo.php");
}