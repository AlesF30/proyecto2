<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');



function alta_estadoCurso($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`estado_curso` (`estado_descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_estadoCurso($id_estado_curso){
    global $connect;

    $sql="DELETE FROM estado_curso WHERE id_estado_curso = $id_estado_curso";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}