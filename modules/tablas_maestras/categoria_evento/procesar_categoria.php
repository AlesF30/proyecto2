<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once('../../../config/database/functions/categoria_evento.php');

$valor= $_POST['nueva_categoria_evento'];
$precio= $_POST['nuevo_precio'];

if(!empty(trim($valor))){
    alta_categoria_eventos($valor, $precio);
    header("location: formulario_categoriaEvento.php");
}else{
    header("location: formulario_categoriaEvento.php");
}