<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');

//CONTRATOS

function alta_estadoContrato($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`estado_contrato` (`descripcion_estado`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_estadoContrato($id_estado_contrato){
    global $connect;

    $sql="DELETE FROM estado_contrato WHERE id_estado_contrato = $id_estado_contrato";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}