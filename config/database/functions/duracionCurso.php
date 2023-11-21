<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

//CONTRATOS

function alta_duracionCurso($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`duracion` (`descripcion_duracion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_duracionCurso($id_duracion){
    global $connect;

    $sql="DELETE FROM duracionWHERE id_duracion = $id_duracion";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}