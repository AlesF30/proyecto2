<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_caracteristica($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`caracteristica` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_caracteristica($id_caracteristica){
    global $connect;

    $sql="DELETE FROM caracteristica WHERE id_caracteristica = $id_caracteristica";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}