<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_periodos($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`periodos` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_periodos($id_periodos){
    global $connect;

    $sql="DELETE FROM periodos WHERE id_periodos = $id_periodos";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}