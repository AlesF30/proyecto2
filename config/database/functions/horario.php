<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_horarios($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`horarios` (`horario_inicio`,`horario_fin`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_tipo_horarios($id_horarios){
    global $connect;

    $sql="DELETE FROM horarios WHERE id_horarios = $id_horarios";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}