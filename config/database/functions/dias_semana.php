<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');
require_once(ROOT_PATH . 'config/database/connect.php');


function alta_diasSemana($valor){
    global $connect;

    $sql="INSERT INTO `sistbook`.`dias` (`descripcion`) VALUES ('$valor');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function baja_diasSemana($id_dias){
    global $connect;

    $sql="DELETE FROM dias WHERE id_dias = $id_dias";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}

function modificar_diasSemana($id_dias, $descripcion){
    global $connect;

    $sql="UPDATE `sistbook`.`dias` SET `descripcion` = '$descripcion' WHERE (`id_dias` = '$id_dias');";


    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}


//DIAS DE LA SEMANA PARA CURSO

function obtenerDiasSemanas($id_dias){
    global $connect;

	$sql="SELECT * FROM sistbook.dias where id_dias = $id_dias;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}
