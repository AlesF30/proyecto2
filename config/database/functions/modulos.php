<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/proyecto/config/path.php');


require_once (ROOT_PATH.'config/database/connect.php');


//MODULOS

function obtenerModulos($id_modulos){
    global $connect;

	$sql="SELECT * FROM sistbook.modulos where id_modulos=$id_modulos;";

	$s = $connect->prepare($sql);

    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

	return $records;
}

// ALTA MODULOS

function alta_modulos($modulos){
    global $connect;

    $sql="INSERT INTO `sistbook`.`modulos` (`descripcion`) VALUES ('$modulos');";

    $s=$connect->prepare($sql);

    $s->execute();

    $s->close();

}


//BAJA MODULOS

function baja_modulos($id_modulos){
    global $connect;

    $sql="DELETE FROM `sistbook`.`modulos` WHERE (`id_modulos` = '$id_modulos');";

	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();

}

//MODIFICAR MODULOS

function modificar_modulos($id_modulos, $descripcion){
    global $connect;
    
	$sql="UPDATE `sistbook`.`modulos` SET `descripcion` = '$descripcion'
        WHERE (`id_modulos` = '$id_modulos');";


	$s = $connect->prepare($sql);

    $s->execute();

    $s->close();
}

function consultarPerfilModulo($id_perfil)
{
    global $connect;
        $connect->begin_transaction();
        $sql = "SELECT m.id_modulos, m.descripcion as valor, nivel, orden, ruta, pm.id_perfiles_modulo, p.id_perfil, pm.rela_modulos, pm.rela_perfil, p.descripcion from modulos m
        inner join perfiles_modulos pm on pm.rela_modulos=m.id_modulos
        inner join perfil p on p.id_perfil=pm.rela_perfil
        where p.id_perfil=$id_perfil and activo=1;";

    $s = $connect->prepare($sql);
    $s->execute();

    $records = $s->get_result()->fetch_all(MYSQLI_ASSOC);

    $s->close();

    return $records;
}