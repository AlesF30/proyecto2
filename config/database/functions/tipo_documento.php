<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


function alta_tipo_documento($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`tipo_documento` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_tipo_documento($id_tipo_documento){
    global $connect;

    $sql="DELETE FROM tipo_documento WHERE id_tipo_documento = $id_tipo_documento";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}