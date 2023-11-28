<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_grupo($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`grupo` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_grupo($id_grupo){
    global $connect;

    $sql="DELETE FROM grupo WHERE id_grupo = $id_grupo";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}