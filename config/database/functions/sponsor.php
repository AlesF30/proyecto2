<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_sponsor($fechaAltaSponsor, $nombreSponsor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`sponsor` (`sponsor_fecha_alta`, `sponsor_nombre`) VALUES ('$fechaAltaSponsor', '$nombreSponsor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_sponsor($id_sponsor){
    global $connect;

    $sql="DELETE FROM sponsor WHERE id_sponsor = $id_sponsor";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}