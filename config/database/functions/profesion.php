<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_profesion($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`profesion` (`descripcion_titulo`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_profesion($id_profesion){
    global $connect;

    $sql="DELETE FROM profesion WHERE id_profesion = $id_profesion";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}