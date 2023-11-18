<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config\database\functions\modalidades.php');


$valor = $_POST['nueva_modalidad'];

if(!empty(trim($valor))){
    alta_modalidad($valor);
    header('location:' . BASE_URL . 'modules\tablas_maestras\Tabla_modalidad\formulario_modalidad.php');
}else{
    header("location: formulario_modalidad.php");
}