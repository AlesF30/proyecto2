<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


//PERFIL
function obtenerPerfil($id_perfil){
    global $connect;

	$sql="SELECT * FROM sistbook.perfil where id_perfil=$id_perfil;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

// ALTA PERFIL

function alta_perfil($perfil){
    global $connect;

    $sql="INSERT INTO `sistbook`.`perfil` (`descripcion`) VALUES ('$perfil');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}


//BAJA PERFIL

function baja_perfil($id_perfil){
    global $connect;

    $sql="DELETE FROM `sistbook`.`perfil` WHERE (`id_perfil` = '$id_perfil');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();

}

//MODIFICAR PERFIL

function modificar_perfil($id_perfil, $descripcion){
    global $connect;
    
	$sql="UPDATE `sistbook`.`perfil` SET `descripcion` = '$descripcion'
        WHERE (`id_perfil` = '$id_perfil');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}

