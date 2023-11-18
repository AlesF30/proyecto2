<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_niveles($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`niveles` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_niveles($id_niveles){
    global $connect;

    $sql="DELETE FROM niveles WHERE id_niveles = $id_niveles";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}