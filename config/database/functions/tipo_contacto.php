<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_tipo_contacto($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`tipo_contacto` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_tipo_contacto($id_tipo_contacto){
    global $connect;

    $sql="DELETE FROM tipo_contacto WHERE id_tipo_contacto = $id_tipo_contacto";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}