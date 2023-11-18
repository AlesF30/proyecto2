<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_tipo_evento($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`tipo_evento` (`tipo_descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_tipo_evento($id_tipo){
    global $connect;

    $sql="DELETE FROM tipo_evento WHERE id_tipo = $id_tipo";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}