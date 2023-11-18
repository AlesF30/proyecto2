<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_pais($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`pais` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_pais($id_pais){
    global $connect;

    $sql="DELETE FROM pais WHERE id_pais = $id_pais";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}