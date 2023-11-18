<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_duracionDias($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`duracion_dias` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_duracionDias($id_duracion_dias){
    global $connect;

    $sql="DELETE FROM duracion_dias WHERE id_duracion_dias = $id_duracion_dias";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}