<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

function alta_modalidad($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`modalidad` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_modalidad($id_modalidad){
    global $connect;

    $sql="DELETE FROM modalidad WHERE id_modalidad = $id_modalidad";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}